<?php

namespace app\controllers;

use Yii;
use app\models\Gusuario;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\SresClientWebSocket;
use app\models\Sautorizacion;
/**
 * Controlador para enviar mensajes a los moviles.
 */
class GmessageController
{
    /*
    * Metodo que envia mensajes a todos los dispositivos conectados
    */
    public static function sendmessageall($titulo, $cuerpo, $estado, $idsolicitud){
        Yii::Warning("intentando enviar al websocket");
        # obtenemos los tokens de los clientes
        $autorizaciones = Sautorizacion::find()
                            ->all();
        $tokens = array();

        foreach ($autorizaciones as $autorizacion) {
            $tokens[] = $autorizacion->token;    
        }
        
        SresClientWebSocket::sendMessageNotificacion($titulo, $cuerpo, $tokens, $estado, $idsolicitud);
    }
}