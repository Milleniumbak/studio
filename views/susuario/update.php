<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Susuario */

$this->title = 'Update Susuario: ' . $model->pkusuario;
$this->params['breadcrumbs'][] = ['label' => 'Susuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pkusuario, 'url' => ['view', 'id' => $model->pkusuario]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="susuario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
