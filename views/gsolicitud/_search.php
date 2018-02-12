<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GsolicitudSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gsolicitud-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pksolicitud') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'fecha_req') ?>

    <?= $form->field($model, 'glosa') ?>

    <?= $form->field($model, 'fkusuario') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
