<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\models\CitySearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="city-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'alias') ?>

    <?= $form->field($model, 'stateId') ?>

   <?php // <?= $form->field($model, 'stateName') ?>

    <?php // echo $form->field($model, 'cityStdCode') ?>

    <?php // echo $form->field($model, 'createdOn') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'ip') ?>

    <?php // echo $form->field($model, 'isFg') ?>

    <?php // echo $form->field($model, 'priority') ?>

    <?php // echo $form->field($model, 'parentCityId') ?>

    <?php // echo $form->field($model, 'updatedOn') ?>

    <?php // echo $form->field($model, 'createdBy') ?>

    <?php // echo $form->field($model, 'updatedBy') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
