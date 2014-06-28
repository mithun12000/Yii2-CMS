<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

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
class CreateUser extends User
{
    public $password2;
    /**
     * @inheritdoc
     */
    
    public function getPassword()
    {
        return '';
    }
    
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
            
            // built-in "compare" validator that is used in "register" scenario only
            ['password', 'compare', 'compareAttribute' => 'password2','message' => 'Confirm Password not matched'],
            // an inline validator defined via the "authenticate()" method in the model class
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
            'updatedOn' => Yii::t('app', 'Updated On'),
            'createdBy' => Yii::t('app', 'Created By'),
            'updatedBy' => Yii::t('app', 'Updated By'),
            'firstname' => Yii::t('app', 'Firstname'),
            'lastname' => Yii::t('app', 'Lastname'),
            'groupId' => Yii::t('app', 'Group ID'),
            'reportTo' => Yii::t('app', 'Report To'),
            'reportUserType' => Yii::t('app', 'Report User Type'),
            'phone' => Yii::t('app', 'Phone'),
            'password' => Yii::t('app', 'Password'),
            'password2' => Yii::t('app', 'Confirm Password'),
        ];
    }
}
