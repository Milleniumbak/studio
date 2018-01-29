<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SautorizacionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sautorizacion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'token') ?>

    <?= $form->field($model, 'topic') ?>

    <?= $form->field($model, 'imei_device') ?>

    <?= $form->field($model, 'fkusuario') ?>

    <?= $form->field($model, 'fecha_registro') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
