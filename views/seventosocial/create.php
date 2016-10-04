<?php

use yii\helpers\Html;

$this->title = 'Evento Social';
$this->params['breadcrumbs'][] = ['label' => 'Seventosocials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seventosocial-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
