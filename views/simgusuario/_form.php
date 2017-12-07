<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;

?>

<div class="simgusuario-form">

    <?php $form = ActiveForm::begin([
    				'options'=>['enctype'=>'multipart/form-data']
									]); 
	?>

	<?= $form->field($model, 'path')->hiddenInput()->label(false)?>
    
	<?= $form->field($model, 'image')->widget(FileInput::classname(), 
			[
    			'options'		=>['accept'=>'image/*'],
    			'pluginOptions'	=>[
    				'allowedFileExtensions'=>['jpg','png'],
    				'showCaption' => false,
					'showRemove'  => false,
					'showUpload'  => false,
                    'maxFileSize' => 5000,
			        'browseClass' => 'btn btn-primary btn-block',
			        'browseIcon'  => '<i class="glyphicon glyphicon-camera"></i> ',
			        'browseLabel' =>  'Seleccione fotografia',
    							  ]
    		]);
	?>
    <?= $form->field($model, 'estado')->hiddenInput()->label(false)?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Subir' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
