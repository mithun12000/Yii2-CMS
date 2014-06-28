<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;
use yii\adminUi\widget\Box;
use yii\adminUi\widget\Row;
use yii\adminUi\widget\Column;
/**
 * @var yii\web\View $this
 * @var common\models\User $model
 */


$this->title = $model->fullname;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

Row::begin();
    Column::begin();
        Box::begin([
            'type' => Box::TYPE_INFO,
            'header' => $this->title,
            'headerIcon' => 'fa fa-user',
            'headerButtonGroup' => true,
            'headerButton' => Html::a('Update', 
                                    ['update', 'id' => $model->Id], 
                                    ['class' => 'btn btn-primary']
                                )
                            .Html::a('Delete', 
                                    ['delete', 'id' => $model->Id], 
                                    [
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
                    'firstname',
                    'lastname',
                    //'Id',
                    'username',
                    //'auth_key',
                    //'password_hash',
                    //'password_reset_token',
                    'email',
                    'phone',
                    //'role',
                    'groupName',
                    'statusName',
                    'createTime',
                    'updateTime',
                    'createdByUser',
                    'updatedByUser',

                    //'groupId',
                    //'reportTo',
                    //'reportUserType',

                ],
            ]);
        Box::end();
        
        Box::begin([
            'type' => Box::TYPE_INFO,
            'header' => 'Groups',
            'headerIcon' => 'fa fa-users',
            'headerButtonGroup' => true,
            'headerButton' => Html::a('Update Groups', 
                                    ['updategroups', 'id' => $model->Id], 
                                    ['class' => 'btn btn-primary']
                                )
        ]);
        
        echo  ListView::widget([
                'dataProvider' => $dataProvider,
                //'showOnEmpty'   => true,
                'emptyText'     => 'No Group Listed',
                'emptyTextOptions' => [
                                        'class' => 'callout callout-danger',
                                        ],
                'options'       => [
                                        'class' => 'list-group'
                                    ],
                'layout'        => '{items}',
                'itemOptions'   =>[
                                    'tag'   => 'a',
                                    'href'  => '#',
                                    'class' => 'list-group-item'
                                ],
                'itemView'      => function($model, $key, $index, $widget){
                                        return $model->groupName;
                                    }
                ]);
        
        Box::end();
        
        Box::begin([
            'type' => Box::TYPE_INFO,
            'header' => 'Permissions',
            'headerIcon' => 'fa fa-shield',
            'headerButtonGroup' => true,
            'headerButton' => Html::a('Update Permissions', 
                                    ['update', 'id' => $model->Id], 
                                    ['class' => 'btn btn-primary']
                                )
        ]);
        Box::end();
    Column::end();
Row::end();
?>