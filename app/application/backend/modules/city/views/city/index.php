<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\CitySearch $searchModel
 */

$this->title = 'Cities';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create City', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="fa fa-trash-o">Trash</span>', ['city-trash/index'], ['class' => 'btn btn-default']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id',
            'name',
            //'alias',
            //'stateId',
           // 'stateName',
            // 'cityStdCode',
            // 'createdOn',
            // 'status',
            // 'ip',
            // 'isFg',
            // 'priority',
            // 'parentCityId',
            // 'updatedOn',
            // 'createdBy',
            // 'updatedBy',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
