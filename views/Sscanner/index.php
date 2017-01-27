<?php
// mejor usar la exrtension de carrito de compra
// https://github.com/omnilight/yii2-shopping-cart
use yii\helpers\Html;
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
                            Yii::getAlias('@web').'/'.'upload/events/'                               .$imgEvent->fkevent 
                                .'/' . $imgEvent->path,
                            ['width' => '100px']
                        );
                },
            ],
            
            [
                'attribute' => 'fkimgevent',
                'value'     => 'fkimgevent0.path',
            ],

            'fechaing',
            // columna 
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{addcart}',
                'controller' => 'sscannerController',
                'buttons' => [
                    'addcart' => function ($url, $model) { 
                        return Html::a('<span class="glyphicon glyphicon-credit-card
"></span>', ['sscanner/addshop',
             'fkimgevent' => $model->fkimgevent
            ], [
                    'title' => 'Adicionar compra',
                    ]);
                }
              ],
            ],        
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

<!-- El modal que se mostrara cuando se haga clic -->
<div id="myModal" class="modal">

  <!-- The Close Button -->
  <span class="close" onclick="document.getElementById('myModal').style.display='none'">&times;</span>

  <!-- Modal Content (The Image) -->
  <img class="modal-content" id="img01">

  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>

