<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = "Solicitudes de repuesto";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gsolicitud-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a("Nueva Solicitud", ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'pksolicitud',            
            'fecha',
            'fecha_req',
            'estado',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
