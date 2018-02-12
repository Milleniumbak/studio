<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Stipousuario;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
?>

<div class="smessage-form">
    <div class="form-group row">
        <label for="tituloid" class="col-sm-2 col-form-label">Titulo de notificacion</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="tituloid" placeholder="Ingrese titulo de mensaje">
        </div>
    </div>
    
    <br>

    <div class="form-group row">
        <label for="messageid" class="col-sm-2 col-form-label">Mensaje de notificacion</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="messageid" placeholder="Ingrese mensaje a enviar">
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4 col-sm-offset-4">
            <?= Html::button("Enviar Notificacion", ["onClick"=>"sendMessageAll()" ,'class' => 'btn btn-primary']) ?>
        </div>        
    </div>
    

</div>
