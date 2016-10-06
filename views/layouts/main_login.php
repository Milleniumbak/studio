<?php 
    use yii\bootstrap\Nav;
    use yii\helpers\Html;

    $isFotografo = false;
    if(Yii::$app->user->identity->getTipoUsuario() == Yii::$app->params['usrFotografo']){
        $isFotografo = true;
    }
    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Inicio', 'url' => ['/site/index']],
            ['label' => 'Perfil', 'url' => ['/susuario/update', 'id'=> Yii::$app->user->identity->getId()]],
            ['label' => 'Deteccion Facial', 'url' => ['/simgusuario/index', 'pkusuario' => Yii::$app->user->identity->getId()]],
        
            $isFotografo ? (
            ['label' => 'Evento Social', 'url' => ['/seventosocial/index']]) : (""),

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