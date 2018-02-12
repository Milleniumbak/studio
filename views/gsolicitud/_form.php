<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\widgets\DatePicker;
use yii\helpers\ArrayHelper;
use app\models\Gusuario;
?>

<div class="gsolicitud-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fecha')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Fecha solicitud'],
            'pluginOptions' => [
                'autoclose'=>true,
                //'format' => 'dd-M-yyyy'
                'format' => 'yyyy-mm-dd'
            ]
        ]);
    ?>

    <?= $form->field($model, 'fecha_req')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Fecha Requerida'],
            'pluginOptions' => [
                'autoclose'=>true,
                //'format' => 'dd-M-yyyy'
                'format' => 'yyyy-mm-dd'
            ]
        ]);
    ?>

    <?= $form->field($model, 'glosa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fkusuario')->widget(
        Select2::className(),
        [
            'hideSearch' => true,
            'data' => ArrayHelper::map(Gusuario::find()->all(), 'pkusuario', 'nombre_usuario'),
            'language'  => 'es',
            'options'   => ['placeholder' => 'Seleccione usuario'],
            'pluginOptions' =>
                [
                    'allowClear' => true,
                ],
        ]
    )
    ?>

    <?= $form->field($model, 'estado')->widget(
        Select2::className(),
        [
            'hideSearch' => true,
            'data' =>  ['PENDIENTE' => "PENDIENTE", 'APROBADO' => "APROBADO", 'RECHAZADA' => "RECHAZADA"],
            'language'  => 'es',
            'options'   => ['placeholder' => 'Estado de solicitud'],
            'pluginOptions' =>
                [
                    'allowClear' => true,
                ],
        ]
    )
    ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? "Guardar" : "Guardar", ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
