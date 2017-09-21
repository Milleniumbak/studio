<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

$this->title = "Evento Social";
$this->params['breadcrumbs'][] = ['label' => 'Eventos Sociales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seventosocial-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->pkevento], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->pkevento], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de eliminar el evento actual?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div style="text-align: center">
        <img class="center-block img-responsive" src="<?= Url::to(['seventosocial/generateqr', 'data' => "$model->smensaje"])?>"                
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'sdescripcion',
            'sdireccion',
            'sfecha',
            'stelefono',
        ],
    ]) ?>

</div>
