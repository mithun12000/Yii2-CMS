<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\CountryTrashSearch $searchModel
 */

$this->title = 'Countries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
       <?= Html::a('Back to Country', ['/country'], ['class' => 'btn btn-success fa fa-long-arrow-left']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id',
            'name',
            'countryCode',
            //'status',
            //'createdOn',
            // 'updatedOn',
            // 'createdBy',
            // 'updatedBy',
            // 'ip',

            ['class' => 'yii\grid\ActionColumn',
                'template' =>'{restore} {delete}',
             ],
        ],
    ]); ?>

</div>
