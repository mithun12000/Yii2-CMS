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
class UpdatePass extends User
{
    public $password2;
    public $oldpassword;
    public $password1;
    /**
     * @inheritdoc
     */
    
    
    public function rules()
    {
        return [
            ['oldpassword', 'validateOldPassword'],
            ['password2', 'compare', 'compareAttribute' => 'password1','message' => 'Confirm Password not matched'],
            ['password1', 'setModelPass'],
        ];
    }
    
    
    public function setModelPass() {
        $this->password = $this->password1;
    }
    
    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     */
    public function validateOldPassword()
    {        
        if (!$this->validatePassword($this->oldpassword)) {
            $this->addError('oldpassword', 'Incorrect Old password.');
        }
    }
    
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [            
            'oldpassword' => Yii::t('app', 'Old Password'),
            'password1' => Yii::t('app', 'Password'),
            'password2' => Yii::t('app', 'Confirm Password'),
        ];
    }
}