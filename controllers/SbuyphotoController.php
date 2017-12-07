<?php

namespace app\controllers;

use Yii;
use yii\BaseYii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\common\components\paypal;
// los modelos que se usaran
use app\models\Scompra;
use app\models\Scompraimpresa;
use app\models\Simgevent;
use app\models\Seventosocial;
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
     * Accion que muestra un listado de las compras
     */
    public function actionList(){
        $total = Yii::$app->cart->getAttributeTotal('price');
        return $this->render('view', ['total'=>$total]);
    }
    /**
     * Muestra el formulario donde se podra seleccionar las compras
     * fkimgevent la imagen que se esta comprando
     */
    public function actionForm($fkimgevent)
    {

        // obtenemos el modelo de imagen
        $modImg = $this->findModelImgEvent($fkimgevent);
        $evento = Seventosocial::findOne($modImg->fkevent);

        $model = new Scompraimpresa();
        $model->tipocompra = 1; # por defecto este tipo de compra
        $model->precio = $evento->sprecioxfoto;
        $model->fkimgevent = $fkimgevent;
        if ($model->load(Yii::$app->request->post())) {
            //solo debemos cargar al carrito
            if($model->tipocompra == 1){ # formato digital
                $model->destipocompra = "Formato digital";
            }else{
                $model->destipocompra = "Formato fisico";
            }
            Yii::$app->cart->add($model);
            // redireccionamos al inicio de la galeria
            return $this->redirect('index.php?r=sscanner/index');
        } else {
            return $this->render('formbuyprint', [
                'model' => $model,
                'modImg' => $modImg,
                'sprecioxfoto' => $evento->sprecioxfoto,
            ]);
        }
    }

    /**
     * Metodo que se ejecuta para enviar a paypal que realiza el pago
     */
    public function actionPay(){
        // aqui llamar al componente de paypal
        $paypal = new paypal();
        // es un array de detalles de compra
        $itemCompras = Yii::$app->cart->getItems();
        $total = Yii::$app->cart->getAttributeTotal('price');
        $response = $paypal->procesarPago($total, $itemCompras, "COMPRA DE FOTOGRAFIAS");

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
    /**
     * Busca el modelo de imagen
     * @param $id identificador primario de imagen
     */
    protected function findModelImgEvent($id)
    {
        if (($model = Simgevent::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Imagen no encontrada.');
        }
    }

}
