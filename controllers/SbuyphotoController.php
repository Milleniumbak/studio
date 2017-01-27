<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
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
    public function actionPay(){

    }
}
