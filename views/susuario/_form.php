<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Susuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="susuario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'snombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sapellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'semail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stelefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'spassword')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stipousuario')->textInput() ?>

    <?= $form->field($model, 'sestado')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
