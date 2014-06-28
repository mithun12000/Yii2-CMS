<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\State;

/**
 * @var yii\web\View $this
 * @var common\models\City $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="city-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'stateId')->dropDownList(ArrayHelper::merge([0=>'Select'], ArrayHelper::map(\common\models\State::find()->andWhere(['status'=>1])->All(), 'Id', 'name'))) ;?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'cityStdCode')->textInput() ?>
    <?= $form-> field($model, 'status')->hiddenInput(['value' => 1])->label('') ?>
<?php
/*
    <?= $form->field($model, 'alias')->textInput(['maxlength' => 100]) ?>

   

    <?= $form->field($model, 'createdOn')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'updatedOn')->textInput() ?>

    <?= $form->field($model, 'createdBy')->textInput() ?>

    <?= $form->field($model, 'updatedBy')->textInput() ?>

    <?= $form->field($model, 'stateId')->textInput() ?>

    <?= $form->field($model, 'isFg')->textInput() ?>

    <?= $form->field($model, 'priority')->textInput() ?>

    <?= $form->field($model, 'parentCityId')->textInput() ?>

    <?= $form->field($model, 'stateName')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'ip')->textInput(['maxlength' => 15]) ?>
 * 
 * 
 */?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
