<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
/*
    renderizar la fecha en la vista
                'attribute' => 'birth_date',
                'format' => ['date', 'dd-MM-Y'],


 */

?>
<div class="simgusuario-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // la fotografia
            [
                'attribute' => 'image',
                'value'     =>  Yii::getAlias('@web')
                                .'upload/faces/'
                                .$model->fkusuario 
                                .'/' . $model->path,
                  'format'    => ['image',['width'=>'200','height'=>'200']],
            ],
        ],
    ]) ?>
    <p style="text-align: center;">
        <?= Html::a('Eliminar', ['delete', 'id' => $model->pkimgusuario], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de eliminar la fotografia?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>


