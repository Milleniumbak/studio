<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Eventos Sociales';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seventosocial-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Nuevo evento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
                'sdescripcion',
                'sdireccion',
                'sfecha',
                'stelefono',
            // nueva columna
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{upload}',
                'controller' => 'SusuarioController',
                'buttons' => [
                    'upload' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon glyphicon-picture
"></span>', ['simgevent/index', 
             'fkevent' => $model->pkevento
            ], [
                                'title' => 'Subir imagenes',
                    ]);
                }
              ],
            ],
            ['class' => 'yii\grid\ActionColumn'],
                    ],
        ]
    ); ?>
<?php Pjax::end(); ?></div>
