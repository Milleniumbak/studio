<?php
// mejor usar la exrtension de carrito de compra
// https://github.com/omnilight/yii2-shopping-cart
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Galeria de fotografias';
?>
<div class="sscanner-index">

    <h1><?= Html::encode($this->title) ?></h1>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [ // esta es la imagen que se intenta mostrar
                'attribute' => 'Fotografia',
                'format' => 'html',
                'value' => function ($model) {
                    $imgEvent = $model->getFkimgevent0()->one();
                    return Html::img(
                            Yii::getAlias('@web').'/'.'upload/events/'.$imgEvent->fkevent
                                .'/water-' . $imgEvent->path,
                            ['width' => '100px']
                        );
                },
            ],

            [
                'attribute' => 'fkimgevent',
                'value'     => 'fkimgevent0.path',
            ],

            'fechaing',
            // nueva columna
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{dialogo}',
                'controller' => 'sbuyphotoController',
                'buttons' => [
                    'dialogo' => function ($url, $model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-shopping-cart"></span>',
                            [
                                'sbuyphoto/form',
                                'fkimgevent' => $model->fkimgevent
                            ],
                            [
                                'title' => 'Adicionar compra'
                            ]
                        );
                    },
                            ],
            ],
            // fin de la columna
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
