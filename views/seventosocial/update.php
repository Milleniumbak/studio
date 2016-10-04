<?php

use yii\helpers\Html;

$this->title = 'Modificacion de evento: ' . $model->pkevento;
$this->params['breadcrumbs'][] = ['label' => 'Seventosocials', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pkevento, 'url' => ['view', 'id' => $model->pkevento]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="seventosocial-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
