<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Simgqr */

$this->title = $model->pkimgqr;
$this->params['breadcrumbs'][] = ['label' => 'Simgqrs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="simgqr-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pkimgqr], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pkimgqr], [
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
            'pkimgqr',
            'fkevento',
            'path',
            'fechaing',
        ],
    ]) ?>

</div>
