<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Simgqr */

$this->title = 'Update Simgqr: ' . $model->pkimgqr;
$this->params['breadcrumbs'][] = ['label' => 'Simgqrs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pkimgqr, 'url' => ['view', 'id' => $model->pkimgqr]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="simgqr-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
