<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SusuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Susuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="susuario-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Susuario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'pkusuario',
            'snombre',
            'sapellido',
            'semail:email',
            'stelefono',
            // 'spassword',
            // 'stipousuario',
            // 'sestado',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
