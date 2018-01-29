<?php

use yii\helpers\Html;


$this->title = 'Enviar Mensaje';

?>
<div class="smessage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form') ?>

</div>
