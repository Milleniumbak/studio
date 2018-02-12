<?php

use yii\helpers\Html;

$this->title = 'Actualizando : ' . $model->codigo_completo;
$this->params['breadcrumbs'][] = ['label' => 'Repuestos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codigo_completo, 'url' => ['view', 'id' => $model->pkarticulo]];
$this->params['breadcrumbs'][] = 'Actualizando';
?>
<div class="grepuesto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
