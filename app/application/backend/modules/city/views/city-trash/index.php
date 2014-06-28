<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\CityTrashSearch $searchModel
 */

$this->title = 'Cities';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-index">

   
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
         <?= Html::a('Back to City', ['/city'], ['class' => 'btn btn-success fa fa-long-arrow-left']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id',
            'name',
            'alias',
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

            ['class' => 'yii\grid\ActionColumn',
              'template' =>'{restore} {delete}',
            ],
        ],
    ]); ?>

</div>
