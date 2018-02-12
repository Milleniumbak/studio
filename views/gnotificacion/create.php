<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Gnotificacion */

$this->title = 'Create Gnotificacion';
$this->params['breadcrumbs'][] = ['label' => 'Gnotificacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gnotificacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
