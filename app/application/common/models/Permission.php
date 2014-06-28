<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tc_permissions".
 *
 * @property integer $Id
 * @property integer $userId
 * @property integer $groupId
 * @property string $module
 * @property string $controller
 * @property string $action
 * @property string $createdOn
 * @property integer $createdBy
 * @property string $updatedOn
 * @property integer $updatedBy
 * @property integer $status
 *
 * @property Group $group
 * @property User $user
 */
class Permission extends \common\component\AppActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%permissions}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'createdOn', 'createdBy', 'updatedOn', 'updatedBy', 'status'], 'required'],
            [['Id', 'userId', 'groupId', 'createdBy', 'updatedBy', 'status'], 'integer'],
            [['createdOn', 'updatedOn'], 'safe'],
            [['module', 'controller', 'action'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => Yii::t('app', 'ID'),
            'userId' => Yii::t('app', 'User ID'),
            'groupId' => Yii::t('app', 'Group ID'),
            'module' => Yii::t('app', 'Module'),
            'controller' => Yii::t('app', 'Controller'),
            'action' => Yii::t('app', 'Action'),
            'createdOn' => Yii::t('app', 'Created On'),
            'createdBy' => Yii::t('app', 'Created By'),
            'updatedOn' => Yii::t('app', 'Updated On'),
            'updatedBy' => Yii::t('app', 'Updated By'),
            'status' => Yii::t('app', 'Status'),
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }
}
