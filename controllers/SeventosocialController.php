<?php

namespace app\controllers;

use Yii;
use app\models\Seventosocial;
use app\models\SeventosocialSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Da\QrCode\QrCode;
use Da\QrCode\Format\BookmarkFormat;
/**
 * SeventosocialController implements the CRUD actions for Seventosocial model.
 */
class SeventosocialController extends Controller
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
     * Lists all Seventosocial models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SeventosocialSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, Yii::$app->user->identity->getId());
        // debemos de mostrar solo los eventos que creamos!!
        Yii::warning("filtramos los eventos propios");
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Muestra un solo modelo del evento social.
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
     * Crea un nuevo modelo del evento social
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Seventosocial();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->sestado = "T";
            // internamente adiciono el id del usuario que lo crea
            $model->fkusuario = Yii::$app->user->identity->getId();
            $model->save();
            return $this->redirect(['view', 'id' => $model->pkevento]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Actualiza un modelo ya existente
     * Si se actualiza correctamente se redirecciona a la pagina 'view'
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // internamente adiciono el id del usuario que lo crea
            $model->fkusuario = Yii::$app->user->identity->getId();
            $model->sestado = "T";
             $model->save();
            return $this->redirect(['view', 'id' => $model->pkevento]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Seventosocial model.
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
     * Metodo que genera un imagen en png con un codigo QR
     * @return [type] [description]
     */
    public function actionGenerateqr($data){
        //Yii::warning("entre a generateQR");
        $qrCode = (new QrCode($data))
                    ->setSize(500) 
                    ->setMargin(5)
                    ->useForegroundColor( 0, 0, 0);
        header('Content-Type: '.$qrCode->getContentType());
        return $qrCode->writeString();        
    }

    /**
     * Finds the Seventosocial model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Seventosocial the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Seventosocial::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Pagina no encontrada!!');
        }
    }
}
