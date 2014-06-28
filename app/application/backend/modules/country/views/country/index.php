<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\CountrySearch $searchModel
 */

$this->title = 'Countries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Country', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="fa fa-trash-o">Trash</span>', ['country-trash/index'], ['class' => 'btn btn-default']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id',
            'name',
            'countryCode',
            'status',
            'createdOn',
            // 'updatedOn',
            // 'createdBy',
            // 'updatedBy',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
