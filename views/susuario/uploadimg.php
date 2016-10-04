<?php

use yii\helpers\Html;
use kartik\widgets\FileInput;
use yii\helpers\Url;
use yii\widgets\ActiveForm;


$this->title = 'Subir imagenes para deteccion de facial';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="susuario-uploadimg">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'path')->widget(FileInput::classname(), [
    				'options' => ['accept' => 'image/*'],
			]);?>

    <?= $form->field($model, 'fechaing[]')->widget(FileInput::classname(), [
    			'options' => ['multiple' => true],
    			'pluginOptions' => ['previewFileType' => 'any']
				]); 
	?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
    </div>

    <?php ActiveForm::end(); ?>


</div>


http://demos.krajee.com/widget-details/fileinput
http://webtips.krajee.com/upload-file-yii-2-using-fileinput-widget/
http://webtips.krajee.com/advanced-upload-using-yii2-fileinput-widget/
http://webtips.krajee.com/read-html5-multiple-file-input-php/
