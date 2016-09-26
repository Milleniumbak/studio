<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Simgusuario */

$this->title = 'Create Simgusuario';
$this->params['breadcrumbs'][] = ['label' => 'Simgusuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="simgusuario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
