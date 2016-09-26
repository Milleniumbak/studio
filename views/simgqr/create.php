<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Simgqr */

$this->title = 'Create Simgqr';
$this->params['breadcrumbs'][] = ['label' => 'Simgqrs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="simgqr-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
