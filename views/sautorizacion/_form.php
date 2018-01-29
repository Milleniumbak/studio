<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Sautorizacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sautorizacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'token')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'topic')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'imei_device')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fkusuario')->textInput() ?>

    <?= $form->field($model, 'fecha_registro')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
