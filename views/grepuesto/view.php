<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->codigo_completo;
$this->params['breadcrumbs'][] = ['label' => 'Repuestos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grepuesto-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Editar', ['update', 'id' => $model->pkarticulo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->pkarticulo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de eliminar el repuesto?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'codigo_completo',
            'nroparte',
            'descripcion',            
            'fkgrupo0.descripcion',
            'fksubgrupo0.descripcion',
            'fkfabricante0.descripcion',
            'fkmodelo0.descripcion',
            'fksistema0.descripcion',

            'fkunidad0.descripcion',
            'fkubicacion0.codigo',
        ],
    ]) ?>
</div>
