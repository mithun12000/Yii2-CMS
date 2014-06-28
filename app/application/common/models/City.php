<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tc_city".
 *
 * @property integer $Id
 * @property string $name
 * @property string $alias
 * @property integer $stateId
 * @property string $stateName
 * @property integer $cityStdCode
 * @property string $createdOn
 * @property integer $status
 * @property string $ip
 * @property integer $isFg
 * @property integer $priority
 * @property integer $parentCityId
 * @property string $updatedOn
 * @property integer $createdBy
 * @property integer $updatedBy
 *
 * @property Restaurant[] $restaurants
 */
class City extends \common\component\AppActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%city}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['stateId', 'cityStdCode', 'status', 'isFg', 'priority', 'parentCityId', 'createdBy', 'updatedBy'], 'integer'],
            [['createdOn', 'updatedOn'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['alias'], 'string', 'max' => 100],
            [['ip'], 'string', 'max' => 15]
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
            'alias' => Yii::t('app', 'Alias'),
            'stateId' => Yii::t('app', 'State ID'),
            'cityStdCode' => Yii::t('app', 'City Std Code'),
            'createdOn' => Yii::t('app', 'Created On'),
            'status' => Yii::t('app', 'Status'),
            'ip' => Yii::t('app', 'Ip'),
            'isFg' => Yii::t('app', 'Is Fg'),
            'priority' => Yii::t('app', 'Priority'),
            'parentCityId' => Yii::t('app', 'Parent City ID'),
            'updatedOn' => Yii::t('app', 'Updated On'),
            'createdBy' => Yii::t('app', 'Created By'),
            'updatedBy' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRestaurants()
    {
        return $this->hasMany(Restaurant::className(), ['cityId' => 'Id']);
    }
}
