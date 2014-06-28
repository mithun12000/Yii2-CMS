<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $role
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends \common\component\AppActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    const ROLE_USER = 1;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * Creates a new user
     *
     * @param  array       $attributes the attributes given by field => value
     * @return static|null the newly created model, or null on failure
     */
    public static function create($attributes)
    {
        /** @var User $user */
        $user = new static();
        $user->setAttributes($attributes);
        $user->setPassword($attributes['password']);
        $user->generateAuthKey();
        if ($user->save()) {
            return $user;
        } else {
            return null;
        }
    }

    
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = NULL)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param  string      $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        $expire = \Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Security::validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Security::generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Security::generateRandomKey();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Security::generateRandomKey() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],

            ['role', 'default', 'value' => self::ROLE_USER],
            ['role', 'in', 'range' => [self::ROLE_USER]],

            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique'],
            [['firstname', 'lastname'], 'string', 'max' => 45],
            [['phone'], 'string', 'max' => 25],
            [['groupId', 'reportTo', 'reportUserType'], 'integer'],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'role' => Yii::t('app', 'Role'),
            'status' => Yii::t('app', 'Status'),
            'createdOn' => Yii::t('app', 'Created On'),
            'createTime' => Yii::t('app', 'Created On'),
            'updateTime' => Yii::t('app', 'Updated On'),
            'updatedOn' => Yii::t('app', 'Updated On'),
            'createdBy' => Yii::t('app', 'Created By'),
            'updatedBy' => Yii::t('app', 'Updated By'),
            'createdByUser' => Yii::t('app', 'Created By'),
            'updatedByUser' => Yii::t('app', 'Updated By'),
            'firstname' => Yii::t('app', 'Firstname'),
            'lastname' => Yii::t('app', 'Lastname'),
            'groupId' => Yii::t('app', 'Group ID'),
            'groupName' => Yii::t('app', 'Primary Group'),
            'phone' => Yii::t('app', 'Phone'),
            
            'MapgroupId' => Yii::t('app', 'Groups'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['Id' => 'groupId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReportTo0()
    {
        return $this->hasOne(User::className(), ['Id' => 'reportTo']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedByWhom()
    {
        return $this->hasOne(User::className(), ['Id' => 'createdBy']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedByWhom()
    {
        return $this->hasOne(User::className(), ['Id' => 'updatedBy']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['reportTo' => 'Id']);
    }
    
    public function getMapedGroups()
    {
        return $this->hasMany(UserGroup::className(), ['userId' => 'Id']);
    }
    
    /*public function getMapgroupId() {
        $data = [];
        foreach($this->MapedGroups as $mappedData){
            $data[] = $mappedData->groupId;
        }
        return $data;
    }*/
    
    public function getFullname() {
        if($this->firstname && $this->lastname){
            return $this->firstname.' '.$this->lastname;
        }else if($this->firstname){
            return $this->firstname;
        }else{
            return $this->username;
        }
    }
    
    public function getCreatedByUser() {
        return $this->createdByWhom->fullname;
    }
    
    public function getUpdatedByUser() {
        return $this->updatedByWhom->fullname;
    }
    
    public function getGroupName() {
        return $this->group->name;
    }
}
