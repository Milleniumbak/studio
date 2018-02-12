<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="grepuesto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'codigo_completo') ?>

    <?= $form->field($model, 'nroparte') ?>

    <?= $form->field($model, 'descripcion') ?>
    
    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>