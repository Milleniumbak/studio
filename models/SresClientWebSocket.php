<?php

namespace app\models;

use Yii;
use yii\BaseYii;
use yii\web\NotFoundHttpException;

use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version2X;


/**
 * Cliente encargado de conectarse al socket nodjs
 */
class SresClientWebSocket
{
    /**
     * Metodo que envia un mensaje al servidor sockect con el id de la mensaje
     * @param $pk identificador primario de la imagen en la base de datos
     * @param $idimgcloud identificador primario de la imagen en la nube
     */
    public static function sendMessageImg($pk, $idimgcloud){

        $data = array(
                "tabla"=>"simgevent", 
                "pk"=>$pk, 
                "idimgcloud"=>$idimgcloud
            );
        
        $url = "";

        if(strlen(Yii::$app->params['SERV_IO_PORT']) > 0 ){
            $url = 'http://' . Yii::$app->params['SERV_IO_HOST'] . ':' . Yii::$app->params['SERV_IO_PORT'];            
        }else{
            $url = 'http://' . Yii::$app->params['SERV_IO_HOST'];
        }

        Yii::Warning('url : ' . $url);
        $client = new Client(new Version2X($url, [
            'headers' => [
                'X-My-Header: websocket rocks',
                'Authorization: Bearer 12b3c4d5e6f7g8h9i'
            ]
        ]));

        $client->initialize();
        $client->emit('message-cliente-php', $data);
        $client->close();


    }


    public static function sendMessageNotificacion($titulo, $mensaje, $tokens, $idimgcloud, $idevent){

        $data = array(
                        "tokens"    =>json_encode($tokens), 
                        "titulo"    =>$titulo, 
                        "cuerpo"    =>$mensaje,
                        "idimgcloud"    =>$idimgcloud,
                        "idevent"   =>$idevent
                    );
        $url = "";

        if(strlen(Yii::$app->params['SERV_IO_PORT']) > 0 ){
            $url = 'http://' . Yii::$app->params['SERV_IO_HOST'] . ':' . Yii::$app->params['SERV_IO_PORT'];            
        }else{
            $url = 'http://' . Yii::$app->params['SERV_IO_HOST'];
        }

        Yii::Warning('url : ' . $url);
        $client = new Client(new Version2X($url, [
            'headers' => [
                'X-My-Header: websocket rocks',
                'Authorization: Bearer 12b3c4d5e6f7g8h9i'
            ]
        ]));

        $client->initialize();
        $client->emit('message-send-firebase', $data);
        $client->close();

    }
}