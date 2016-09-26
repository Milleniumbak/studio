<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SeventosocialSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="seventosocial-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pkevento') ?>

    <?= $form->field($model, 'sdescripcion') ?>

    <?= $form->field($model, 'sdireccion') ?>

    <?= $form->field($model, 'sfecha') ?>

    <?= $form->field($model, 'stelefono') ?>

    <?php // echo $form->field($model, 'sestado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
