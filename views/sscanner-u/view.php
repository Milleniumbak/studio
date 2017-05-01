<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->pkscanner;
$this->params['breadcrumbs'][] = ['label' => 'Sscanners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sscanner-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pkscanner], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pkscanner], [
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
            'pkscanner',
            'fkusuario',
            'fkimgevent',
            'estado',
            'fechaing',
        ],
    ]) ?>

</div>
