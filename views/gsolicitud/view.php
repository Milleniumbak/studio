<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = "Solicitud nro : " . $model->pksolicitud;
$this->params['breadcrumbs'][] = ['label' => "Solicitudes", 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gsolicitud-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a("Editar", ['update', 'id' => $model->pksolicitud], ['class' => 'btn btn-primary']) ?>
        <?= Html::a("Eliminar", ['delete', 'id' => $model->pksolicitud], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => "Esta seguro de eliminar esta solicitud",
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pksolicitud',
            'fecha',
            'fecha_req',
            'glosa',
            'fkusuario0.nombre_usuario',
            'estado',
        ],
    ]) ?>

</div>
