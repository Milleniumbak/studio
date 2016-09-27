<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Susuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="susuario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'snombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sapellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'semail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stelefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'spassword')->passwordInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'password_repeat')->passwordInput(['maxlength'=>true]) ?>

    <?= $form->field($model, 'authkey')->hiddenInput()->label(false)?>

    <?= $form->field($model, 'accesstoken')->hiddenInput()->label(false) ?>
    
    <?= $form->field($model, 'stipousuario')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'sestado')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
