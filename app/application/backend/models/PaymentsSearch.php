<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Payments;

/**
 * PaymentsSearch represents the model behind the search form about `common\models\Payments`.
 */
class PaymentsSearch extends Payments
{
    public function rules()
    {
        return [
            [['Id', 'createdBy', 'updatedBy', 'status'], 'integer'],
            [['name', 'createdOn', 'updatedOn', 'IP'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Payments::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'Id' => $this->Id,
            'createdBy' => $this->createdBy,
            'updatedBy' => $this->updatedBy,
            'createdOn' => $this->createdOn,
            'updatedOn' => $this->updatedOn,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'IP', $this->IP]);

        return $dataProvider;
    }
}
