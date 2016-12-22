<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;

?>

<div class="simgevent-form">

    <?php $form = ActiveForm::begin([
    				'options'=>	[
    						'enctype' => 'multipart/form-data'
    							]
									]); ?>
    
	<?= $form->field($model, 'fkevent')->hiddenInput()->label(false)?>
	
	<?= $form->field($model, 'path')->hiddenInput()->label(false)?>

	<?php echo $form->field($model, 'image[]')->widget(FileInput::classname(), 
			[
    			'options'		=>	[
    									'accept'=>'image/*', 
    									'multiple'=>true
    								],
    			'pluginOptions'	=>
    							[
    				'allowedFileExtensions'=>['jpg','png'],
    				'showCaption' => false,
					'showRemove' => false,
					'showUpload' => false,
			        'browseClass' => 'btn btn-primary btn-block',
			        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
			        'browseLabel' =>  'Seleccione fotografia',
    							]
    		]);
	?>

	<?php 
		/*echo $form->field($model, 'image')->widget(FileInput::classname(), 
			[
    			'options'		=>['accept'=>'image/*'],
    			'pluginOptions'	=>[
    				'allowedFileExtensions'=>['jpg','png'],
    				'showCaption' => false,
					'showRemove' => false,
					'showUpload' => false,
			        'browseClass' => 'btn btn-primary btn-block',
			        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
			        'browseLabel' =>  'Seleccione fotografia',
    							  ]
    		]);*/
	?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Subir' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
