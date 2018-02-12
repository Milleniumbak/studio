<?php

use yii\helpers\Html;

$this->title = "Editando Solicitud";
$this->params['breadcrumbs'][] = ['label' => "Solicitudes", 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pksolicitud, 'url' => ['view', 'id' => $model->pksolicitud]];
$this->params['breadcrumbs'][] = "Editando";
?>
<div class="gsolicitud-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
