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
        <?= Html::a('Update', ['update', 'id' => $model->pkusuario], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pkusuario], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pkusuario',
            'snombre',
            'sapellido',
            'semail:email',
            'stelefono',
            'spassword',
            'stipousuario',
            'sestado',
        ],
    ]) ?>

</div>
