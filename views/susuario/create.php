<?php

use yii\helpers\Html;

$this->title = 'Crear usuario';
?>
<div class="susuario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
