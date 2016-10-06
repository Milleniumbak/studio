<?php

use yii\helpers\Html;


$this->title = 'Subir Fotografia';

?>
<div class="simgusuario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
