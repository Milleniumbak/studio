<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Simgusuario */

$this->title = 'Update Simgusuario: ' . $model->pkimgusuario;
$this->params['breadcrumbs'][] = ['label' => 'Simgusuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pkimgusuario, 'url' => ['view', 'id' => $model->pkimgusuario]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="simgusuario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
