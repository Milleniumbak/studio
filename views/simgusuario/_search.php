<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SimgusuarioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="simgusuario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pkimgusuario') ?>

    <?= $form->field($model, 'fkusuario') ?>

    <?= $form->field($model, 'path') ?>

    <?= $form->field($model, 'fechaing') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
