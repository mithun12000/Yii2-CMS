<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tc_country".
 *
 * @property integer $Id
 * @property string $name
 * @property string $countryCode
 * @property integer $status
 * @property string $createdOn
 * @property string $updatedOn
 * @property integer $createdBy
 * @property integer $updatedBy
 */
class Country extends \common\component\AppActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%country}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'countryCode'], 'required'],
            [['status', 'createdBy', 'updatedBy'], 'integer'],
            [['createdOn', 'updatedOn'], 'safe'],
            [['name', 'countryCode'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'countryCode' => Yii::t('app', 'Country Code'),
            'status' => Yii::t('app', 'Status'),
            'createdOn' => Yii::t('app', 'Created On'),
            'updatedOn' => Yii::t('app', 'Updated On'),
            'createdBy' => Yii::t('app', 'Created By'),
            'updatedBy' => Yii::t('app', 'Updated By'),
        ];
    }
}
