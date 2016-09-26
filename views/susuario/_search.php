<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SusuarioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="susuario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pkusuario') ?>

    <?= $form->field($model, 'snombre') ?>

    <?= $form->field($model, 'sapellido') ?>

    <?= $form->field($model, 'semail') ?>

    <?= $form->field($model, 'stelefono') ?>

    <?php // echo $form->field($model, 'spassword') ?>

    <?php // echo $form->field($model, 'stipousuario') ?>

    <?php // echo $form->field($model, 'sestado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
