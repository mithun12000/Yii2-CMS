<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Country;

/**
 * CountryTrashSearch represents the model behind the search form about `common\models\Country`.
 */
class CountryTrashSearch extends Country
{
    public function rules()
    {
        return [
            [['Id', 'status', 'createdBy', 'updatedBy'], 'integer'],
            [['name', 'countryCode', 'createdOn', 'updatedOn', 'ip'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Country::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->setSort([
                'defaultOrder' => [                    
                    'updatedOn' => SORT_DESC,
                    
                ]
            ]);

         $query->andFilterWhere([
             Country::tableName().'.status' => '0',
            ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'Id' => $this->Id,
            'status' => $this->status,
            'createdOn' => $this->createdOn,
            'updatedOn' => $this->updatedOn,
            'createdBy' => $this->createdBy,
            'updatedBy' => $this->updatedBy,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'countryCode', $this->countryCode])
            ->andFilterWhere(['like', 'ip', $this->ip]);

        return $dataProvider;
    }
}
