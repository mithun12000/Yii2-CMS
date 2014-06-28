<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tc_entity".
 *
 * @property integer $id
 * @property string $name
 * @property string $created
 * @property string $modified
 */
class Entity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%entity}}';
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created', 'modified'], 'safe'],
            [['modified'], 'required'],
            [['name','cusine','feature'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'cuisine' => 'Cuisine',
            'feature' => 'Feature',
            'modified' => 'Modified',
        ];
    }
    
    public function getcusine() {
        return 'test';
        
    }
    
    public function getfeature() {
        return 'test';
        
    }
    
    public function setcusine() {
        
        
    }
    
    public function setfeature() 
            {
           }
    
     
}
