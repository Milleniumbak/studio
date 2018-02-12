<?php

use yii\helpers\Html;

$this->title = "Solicitud de repuesto";
$this->params['breadcrumbs'][] = ['label' => "Solicitudes", 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gsolicitud-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
