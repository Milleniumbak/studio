<?php
// este es donde sale el listado final antes de hacer clik pagar
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
//use cart\widgets\CartGrid;
use yii2mod\cart\widgets\CartGrid;
$this->title = 'Fotografias a comprar :: ';
?>
    <h1><?= Html::encode($this->title) ?></h1>

<?php Pjax::begin(); ?>
	<?php echo CartGrid::widget([
	    'cartColumns' => [
	    	['class' => 'yii\grid\SerialColumn'],
            "destipocompra",
            'fkimgevent0.path',
            'fkdimension0.descripcion',
            'fktipopapel0.descripcion',
	        'cantidad',
	        'precio'
	    ]
	]); ?>
<?php Pjax::end(); ?>

<h4><?= Html::encode('Monto a pagar : ' . $total . ' Bs.-')?></h4>
<p>
    <?= Html::a('<span class="glyphicon glyphicon-usd" aria-hidden="true"></span> Pagar con paypal', ['sbuyphoto/pay'], ['class' => 'btn btn-warning']) ?>
</p>
</div>
