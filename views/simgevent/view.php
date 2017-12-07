<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/*
    renderizar la fecha en la vista
                'attribute' => 'birth_date',
                'format' => ['date', 'dd-MM-Y'],

 */

?>
<div class="simgevent-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // la fotografia
            [
                'attribute' => 'image',
                'value'     =>  "https://drive.google.com/uc?id=" . $model->idimagecloud,
                  'format'    => ['image',['width'=>'200','height'=>'200']],
            ],
        ],
    ]) ?>
    <p style="text-align: center;">
        <?= Html::a('Eliminar', [
                                'delete', 
                                'id' => $model->pkimgevent,
                                ], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de eliminar la fotografia?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>
