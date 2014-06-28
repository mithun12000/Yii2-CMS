<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\adminUi\widget\Box;
use yii\adminUi\widget\Row;
use yii\adminUi\widget\Column;
/**
 * @var yii\web\View $this
 * @var app\models\group $model
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

Row::begin();
    Column::begin();
        Box::begin([
            'type' => Box::TYPE_INFO,
            'header' => $this->title,
            'headerIcon' => 'fa fa-users',
            'headerButtonGroup' => true,
            'headerButton' => Html::a('Update', [
                                                    'update', 
                                                    'id' => $model->Id], 
                                                    ['class' => 'btn btn-primary']
                            )
                            .Html::a('Delete', ['delete', 'id' => $model->Id], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ])
        ]);
        echo  DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        #'Id',
                        'name',
                        'parentGroup',
                        'StatusName',
                        //'createdon',
                        'CreateTime'
                    ],
                ]);
        Box::end();
        Box::begin([
            'type' => Box::TYPE_INFO,
            'header' => 'Permission',
            'headerIcon' => 'fa fa-users',
            'headerButtonGroup' => true,
            'headerButton' => Html::a('Update Permissions', 
                                    ['grouppermission/update', 'groupId' => $model->Id], 
                                    ['class' => 'btn btn-primary']
                                )
        ]);
        Box::end();
    Column::end();
Row::end();
?>
