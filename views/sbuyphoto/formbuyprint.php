<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use app\models\Stipopapel;
use app\models\Sdimension;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

?>
<?php $this->title = 'Compra de imagen'; ?>
<div class="scompraonline-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-4">
            <?= Html::img(Yii::getAlias('@web').'/'.'upload/events/' . $modImg->fkevent . '/water-' . $modImg->path,
                    [
                        "class" => "img-responsive",
                        "alt" => "Fotografia",
                        "width" => "400"
                    ])?>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12">
                    <h3>SELECCIONE LA CARACTERISTICA DE SU IMAGEN</h3>
                    <?= $form->field($model, 'pkcompraimpresa')->hiddenInput()->label(false)?>
                    <?= $form->field($model, 'fkcompra')->hiddenInput()->label(false)?>
                    <?= $form->field($model, 'item')->hiddenInput()->label(false)?>
                    <?= $form->field($model, 'fkimgevent')->hiddenInput()->label(false)?>
                    <?= Html::hiddenInput('sprecioxfoto', $sprecioxfoto, ["id" => "sprecioxfoto1"]);?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">

                </div>
                <div class="col-md-8">
                    <?= $form->field($model, 'tipocompra')->radioList([
                                    '1' => 'Formato digital',
                                    '2' => 'Formato fisico',
                        ],
                        ['onchange' => "modificarControles(this)"]
                        );
                    ?>
                </div>
            </div>
            <!-- fila de tipo de fotografia -->
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'fktipopapel')->widget(
                        Select2::className(),
                        [
                            'hideSearch' => true,
                            'data' => ArrayHelper::map(Stipopapel::find()->all(), 'pktipopapel', 'descripcion'),
                            'language'  => 'es',
                            'options'   =>
                                [
                                    'placeholder' => 'Seleccione papel fotografico',
                                    'disabled' => true
                                ],
                            'pluginOptions' =>
                                [
                                    'allowClear' => true,
                                ],
                        ]
                    )
                    ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'fkdimension')->widget(
                        Select2::className(),
                        [
                            'hideSearch' => true,
                            'data' => ArrayHelper::map(Sdimension::find()->all(), 'pkdimension', 'descripcion'),
                            'language'  => 'es',
                            'options'   =>
                                [
                                    'placeholder' => 'Seleccione dimension de fotografia',
                                    'disabled' => true,
                                ],
                            'pluginOptions' =>
                                [
                                    'allowClear' => true,
                                ],
                        ]
                    )
                    ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">

                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'cantidad')->textInput([   'type' => 'number',
                                                                        "min"=>"1",
                                                                        "max"=>"10",
                                                                        "value" => "1",
                                                                        "step"=>"1",
                                                                        "onclick" =>"calcularprecio(this.value)"
                                                                        ])?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'precio')->textInput(["readonly"=>"true"])?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">

                </div>
                <div class="col-sm-2">
                    <?= Html::submitButton('Agregar al carro de compra', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
