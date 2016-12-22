<?php

use yii\helpers\Html;

$this->title = 'Evento Social';
$this->params['breadcrumbs'][] = ['label' => 'Eventos Sociales', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Evento Social';
?>
<div class="seventosocial-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
