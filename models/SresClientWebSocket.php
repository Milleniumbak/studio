<?php

namespace app\models;

use Yii;
use yii\BaseYii;
use yii\web\NotFoundHttpException;
use app\models\SocketIO;
/**
 * Cliente encargado de conectarse al socket nodjs
 */
class SresClientWebSocket
{
    /**
     * Metodo que envia un mensaje al servidor sockect
     * @param $pk identificador primario de la imagen en la base de datos
     * @param $idimgcloud identificador primario de la imagen en la nube
     */
    public static function sendMessageImg($pk, $idimgcloud){
        $data = array("tabla"=>"simgevent", "pk"=>$pk, "idimgcloud"=>$idimgcloud);

        $socketio = new SocketIO();
        if ($socketio->send(Yii::$app->params['SERV_IO_HOST'], Yii::$app->params['SERV_IO_PORT'], 'message-cliente-php', json_encode($data))){
            Yii::Warning('Enviamos y desconectamos el socket');
        } else {
            Yii:Warning('error de servicio');
        }
    }
}