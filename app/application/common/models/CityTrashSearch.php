<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\City;

/**
 * CityTrashSearch represents the model behind the search form about `common\models\City`.
 */
class CityTrashSearch extends City
{
    public function rules()
    {
        return [
           [['status'], 'integer'],
            [['name', 'alias', 'createdOn', 'ip', 'updatedOn'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = City::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->setSort([
                'defaultOrder' => [                    
                    'updatedOn' => SORT_DESC
                ]
            ]);

         $query->andFilterWhere([
             City::tableName().'.status' => '0',
            ]);
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'Id' => $this->Id,
            'stateId' => $this->stateId,
            'cityStdCode' => $this->cityStdCode,
            'createdOn' => $this->createdOn,
            'status' => $this->status,
            'isFg' => $this->isFg,
            'priority' => $this->priority,
            'parentCityId' => $this->parentCityId,
            'updatedOn' => $this->updatedOn,
            'createdBy' => $this->createdBy,
            'updatedBy' => $this->updatedBy,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'ip', $this->ip]);

        return $dataProvider;
    }
}
