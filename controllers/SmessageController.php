<?php

namespace app\controllers;

use Yii;
use app\models\Susuario;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\SresClientWebSocket;
use app\models\Sautorizacion;
/**
 * Controlador para enviar mensajes a los moviles.
 */
class SmessageController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Muestra el formulario para enviar mensajes.
     * @param integer $id
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('send');
    }
    /*
    * Metodo que envia mensajes a todos los dispositivos conectados
    */
    public function actionSendmessageall($titulo, $cuerpo){
        Yii::Warning("intentando enviar al websocket");
        # obtenemos los tokens de los clientes
        $autorizaciones = Sautorizacion::find()
                            ->all();
        $tokens = array();

        foreach ($autorizaciones as $autorizacion) {
            $tokens[] = $autorizacion->token;    
        }
        
        SresClientWebSocket::sendMessageNotificacion($titulo, $cuerpo, $tokens, "4", "1");

        return json_encode("mensaje enviado!");
    }
}