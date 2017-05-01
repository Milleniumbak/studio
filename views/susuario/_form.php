<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Stipousuario;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
?>

<div class="susuario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'snombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sapellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stipousuario')->widget(
        Select2::className(),
        [
            'hideSearch' => true,
            'data' => ArrayHelper::map(Stipousuario::find()->all(), 'pktipousuario', 'descripcion'),
            'language'  => 'es',
            'options'   => ['placeholder' => 'Seleccione Suscripcion'],
            'pluginOptions' =>
                [
                    'allowClear' => true,
                ],
        ]
    )
    ?>
    <?= $form->field($model, 'semail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stelefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'spassword')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_repeat')->passwordInput(['maxlength'=>true]) ?>

    <?= $form->field($model, 'authkey')->hiddenInput()->label(false)?>

    <?= $form->field($model, 'accesstoken')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'sestado')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
