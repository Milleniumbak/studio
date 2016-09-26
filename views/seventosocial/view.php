<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Seventosocial */

$this->title = $model->pkevento;
$this->params['breadcrumbs'][] = ['label' => 'Seventosocials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seventosocial-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pkevento], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pkevento], [
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
            'pkevento',
            'sdescripcion',
            'sdireccion',
            'sfecha',
            'stelefono',
            'sestado',
        ],
    ]) ?>

</div>
