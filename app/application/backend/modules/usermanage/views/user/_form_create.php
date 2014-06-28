<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/**
 * @var yii\web\View $this
 * @var common\models\User $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if(!$model->isNewRecord){ ?>
    <?= $form->field($model, 'status')->dropDownList($model->getStatus(),[]) ?>    
    <?php }else{ ?>
    <?= $form->field($model, 'status')->hiddenInput(['value' => 1])->label('') ?>
    <?php } ?>

    <?php //<?= $form->field($model, 'role')->textInput() ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'firstname')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'lastname')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => 25]) ?>

    <?= $form->field($model, 'groupId')->dropDownList(ArrayHelper::merge([0=>'Select'], ArrayHelper::map(\common\models\Group::find()
                             ->where(['status' => '1'])->all(),'Id','name'))) ?>
    
    <?= $form->field($model, 'password')->passwordInput() ?>
    
    <?= $form->field($model, 'password2')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
