<?php

use yii\helpers\Html;
use yii\adminUi\widget\ActiveForm;
use yii\helpers\ArrayHelper;

/**
 * @var yii\web\View $this
 * @var common\models\User $model
 * @var yii\widgets\ActiveForm $form
 */

//print_r($model->groupMap);
?>
<div class="user-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'groupMap')->checkboxList(ArrayHelper::map(\common\models\Group::find()
                             ->where(['status' => '1'])->all(),'Id','name'),[
                                 //'tag'  => 'ul',
                                 'class'    => 'list-group',
                                 'itemOptions'=>[
                                     //'tag'  => 'li',
                                     'class'    => 'list-group-item',
                                     'container'    => [
                                         'class'    => 'list-group-item',
                                     ],
                                 ],
                             ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
