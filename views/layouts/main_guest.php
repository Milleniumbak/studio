<?php 
    use yii\bootstrap\Nav;
    use yii\helpers\Html;

    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Inicio', 'url' => ['/site/index']],
            ['label' => 'Crear Cuenta', 'url' => ['/susuario/create']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                . Html::submitButton(
                    'Cerrar session (' . Yii::$app->user->identity->getUsername() . ')',
                    ['class' => 'btn btn-link']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
 ?>