<?php

namespace app\controllers;

use Yii;
use app\models\Gsolicitud;
use app\controllers\GmessageController;
use app\models\GsolicitudSearch;
use app\models\Gnotificacion;
use yii\web\Controller;
use yii\db\Expression;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GsolictudController implements the CRUD actions for Gsolicitud model.
 */
class GsolicitudController extends Controller
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
     * Lists all Gsolicitud models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GsolicitudSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Gsolicitud model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    
    /**
     * Creates a new Gsolicitud model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Gsolicitud();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // aqui cambiar los formatos de fecha de local a server
            //$model->fecha = date('Y-m-d H:i:s',strtotime($currentDate));
            if($model->estado != "PENDIENTE"){
                GmessageController::sendmessageall(
                    'Solicitud de Repuesto - $model->estado',
                    'La solicitud nro. : $model->pksolicitud - fue $model->estado. \n Por favor apersonarse a por almacenes.',
                    $model->estado,
                    $model->pksolicitud                   
                );                
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->pksolicitud]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Updates an existing Gsolicitud model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // guardamos y enviamos el mensaje
            $model->save();
            Yii::Warning("guarde la solicitud");
            if($model->estado != "PENDIENTE"){
                // guardamos la notificacion
                Yii::Warning("guardando notificacion");
                $noti = new Gnotificacion();
                $noti->codigo = "" . $model->pksolicitud;
                $noti->codigoSol = str_pad($model->pksolicitud, 10, "0", STR_PAD_LEFT);
                $noti->titulo = 'Solicitud de Repuesto - ' . $model->estado;
                $noti->cuerpo = 'La solicitud nro. : ' . $model->pksolicitud . ' - fue ' . $model->estado . ' Por favor apersonarse por almacenes.';
                $noti->estado = $model->estado;
                $noti->fecha = new Expression('NOW()');
                $noti->fkusuario = $model->fkusuario;
                if($noti->validate()){
                    Yii::Warning("Correctamente valido");
                    $noti->save();
                }else{
                    Yii::Warning("Error : " . json_encode($noti->errors));
                }
                

                

                GmessageController::sendmessageall(
                    $noti->titulo,
                    $noti->cuerpo,
                    $noti->estado,
                    $model->pksolicitud                   
                );                
            }            
            return $this->redirect(['view', 'id' => $model->pksolicitud]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Gsolicitud model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Gsolicitud model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Gsolicitud the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Gsolicitud::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
