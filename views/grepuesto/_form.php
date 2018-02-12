<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Ggrupo;
use app\models\Gfabricante;
use app\models\Gmodelo;
use app\models\Gsistema;
use app\models\Gsubgrupo;
use app\models\Gunidad;
use app\models\Gubicacion;
use yii\web\View;
?>

<div class="grepuesto-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'fkgrupo')->widget(
        Select2::className(),
        [
            'hideSearch' => true,
            'data' => ArrayHelper::map(Ggrupo::find()->all(), 'pkgrupo', 'descripcion'),
            'language'  => 'es',
            'options'   => [
                'placeholder' => 'Seleccione Grupo',
                'onchange' => 'getcodGrupo()',
                        ],
            'pluginOptions' =>
                [
                    'allowClear' => true,
                ],
        ]
    )
    ?>

    <?= $form->field($model, 'fksubgrupo')->widget(
        Select2::className(),
        [
            'hideSearch' => true,
            'data' => ArrayHelper::map(Gsubgrupo::find()->all(), 'pksubgrupo', 'descripcion'),
            'language'  => 'es',
            'options'   => [
                    'placeholder' => 'Seleccione Sub-grupo',
                    'onchange' => 'getcodSubGrupo()',
                ],
            'pluginOptions' =>
                [
                    'allowClear' => true,
                ],
        ]
    )
    ?>

    <?= $form->field($model, 'fkfabricante')->widget(
        Select2::className(),
        [
            'hideSearch' => true,
            'data' => ArrayHelper::map(Gfabricante::find()->all(), 'pkfrabrica', 'descripcion'),
            'language'  => 'es',
            'options'   => [
                    'placeholder' => 'Seleccione Fabricante',
                    'onchange' => 'getcodFabricante()',
                ],
            'pluginOptions' =>
                [
                    'allowClear' => true,
                ],
        ]
    )
    ?>

    <?= $form->field($model, 'fkmodelo')->widget(
        Select2::className(),
        [
            'hideSearch' => true,
            'data' => ArrayHelper::map(Gmodelo::find()->all(), 'pkmodelo', 'descripcion'),
            'language'  => 'es',
            'options'   => [
                    'placeholder' => 'Seleccione Modelo',
                    'onchange' => 'getcodModelo()',
                ],
            'pluginOptions' =>
                [
                    'allowClear' => true,
                ],
        ]
    )
    ?>

    <?= $form->field($model, 'fksistema')->widget(
        Select2::className(),
        [
            'hideSearch' => true,
            'data' => ArrayHelper::map(Gsistema::find()->all(), 'pksistema', 'descripcion'),
            'language'  => 'es',
            'options'   => [
                    'placeholder' => 'Seleccione Sistema',
                    'onchange' => 'getcodSistema()',
                ],
            'pluginOptions' =>
                [
                    'allowClear' => true,
                ],
        ]
    )
    ?>


    <?= $form->field($model, 'nroparte')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codigo_completo')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'fkunidad')->widget(
        Select2::className(),
        [
            'hideSearch' => true,
            'data' => ArrayHelper::map(Gunidad::find()->all(), 'pkunidad', 'descripcion'),
            'language'  => 'es',
            'options'   => ['placeholder' => 'Seleccione Unidad'],
            'pluginOptions' =>
                [
                    'allowClear' => true,
                ],
        ]
    )
    ?>


    <?= $form->field($model, 'fkubicacion')->widget(
        Select2::className(),
        [
            'hideSearch' => true,
            'data' => ArrayHelper::map(Gubicacion::find()->all(), 'pkubicacion', 'descripcion'),
            'language'  => 'es',
            'options'   => ['placeholder' => 'Seleccione ubicacion'],
            'pluginOptions' =>
                [
                    'allowClear' => true,
                ],
        ]
    )
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>