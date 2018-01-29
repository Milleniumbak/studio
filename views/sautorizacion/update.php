<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sautorizacion */

$this->title = 'Update Sautorizacion: ' . $model->token;
$this->params['breadcrumbs'][] = ['label' => 'Sautorizacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->token, 'url' => ['view', 'id' => $model->token]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sautorizacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
