<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->pkusuario;
$this->params['breadcrumbs'][] = ['label' => 'Susuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="susuario-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->pkusuario], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->pkusuario], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de eliminar el usuario?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'snombre',
            'sapellido',
            'semail:email',
            'stelefono',
        ],
    ]) ?>

</div>
