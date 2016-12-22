<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = "Fotografias de : " . strtoupper($data);
?>
<div class="simgevent-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Subir Fotografias', 
                        [
                            'create', 
                            'fkevent'=> $fkevent, 
                            'data' => $data
                        ], ['class' => 'btn btn-success']) ?>
    </p>

<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'path',
            'fechaing',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
