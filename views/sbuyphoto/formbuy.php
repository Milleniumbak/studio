<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use app\models\Stipoevento;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
?>
<!-- aqui se va a configurar la compra en el modal -->
<div class="scompra-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sdescripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fktipoevento')->widget(
        Select2::className(),
        [
            'hideSearch' => true,
            'data' => ArrayHelper::map(Stipoevento::find()->all(), 'pktipoevento', 'descripcion'),
            'language'  => 'es',
            'options'   => ['placeholder' => 'Seleccione tipo de evento'],
            'pluginOptions' =>
                [
                    'allowClear' => true,
                ],
        ]
    )
    ?>

    <?= $form->field($model, 'sdireccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sfecha')->widget( DatePicker::classname(), [
                'options' => ['placeholder' => 'Ingrese la fecha'],
                'type' => DatePicker::TYPE_INPUT,
                'pluginOptions' =>  [
                        'autoclose'=>true,
                        //'format' => 'dd-M-yyyy'
                        'format' => 'yyyy-mm-dd'
                                    ]
        ]);
    ?>

    <?= $form->field($model, 'stelefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'smensaje')->textInput(['maxlength' => true, 'value' => 'http://www.studio.ddns.net']) ?>

    <?= $form->field($model, 'path')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
