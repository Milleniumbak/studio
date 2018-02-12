<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Gnotificacion */

$this->title = 'Update Gnotificacion: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Gnotificacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pkNotificacion, 'url' => ['view', 'id' => $model->pkNotificacion]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="gnotificacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
