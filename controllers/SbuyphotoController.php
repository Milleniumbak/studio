<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\common\components\paypal;
/**
 * Controlador para la compra de fotografias
 */
class SbuyphotoController extends Controller
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
     * Muestra un listado de fotografias que hay en el carrito de compras
     * @param integer $id
     * @return mixed
     */
    public function actionFormulario()
    {
        $total = Yii::$app->cart->getAttributeTotal('price');
        return $this->render('view', ['total'=>$total]);
    }
    /**
     * Metodo que se ejecuta para enviar a paypal que realiza el pago
     */
    public function actionPay(){
        // aqui llamar al componente de paypal
        $paypal = new paypal();
        // es un array de fotos de evento
        $imgEvents = Yii::$app->cart->getItems();
        $total = Yii::$app->cart->getAttributeTotal('price');
        $response = $paypal->procesarPago($total, $imgEvents, "COMPRA DE FOTOGRAFIAS");

        $url = $response->links[1]->href;
        //echo 'Redirect user here:'.$url.'<br/><br/>';
        //var_dump($response);

        header('Location: '.$url);
        die();
        //return $this->render('view', ['total'=>$total]);
    }
    /**
     * Aqui llegara la respuesta de paypal
     */
    public function actionResponse($success){
        $total = 0;
        if($success == true){
            $total = 0;
        }else{
            $total = -1;
        }
        return $this->render('view', ['total'=>$total]);
    }
}
