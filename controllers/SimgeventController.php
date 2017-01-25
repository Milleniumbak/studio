<?php

namespace app\controllers;

use Yii;
use app\models\Simgevent;
use app\models\Seventosocial;
use app\models\SimgeventSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Expression;
use yii\helpers\FileHelper;


/**
 * SimgeventController implements the CRUD actions for Simgevent model.
 */
class SimgeventController extends Controller
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
     * Lista todas las imagenes del evento seleccionado anteriormente
     * @return mixed
     */
    public function actionIndex($fkevent)
    {
        $searchModel = new SimgeventSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $fkevent);
        //Yii::warning("pase index action de imgen");
        $model = Seventosocial::findOne(['pkevento' => $fkevent]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'data' => $model->sdescripcion,
            'fkevent' => $fkevent,
        ]);
    }

    /**
     * Displays a single Simgevent model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $mEvento = Seventosocial::findOne(['pkevento' => $model->fkevent]);
        return $this->render('view', [
            'model' => $model,
            'data'  => $mEvento->sdescripcion,
        ]);
    }

    /**
     * Creates a new Simgevent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($fkevent)
    {

        $model = new Simgevent();
        yii::warning("Pase a action create");
        if($model->load(Yii::$app->request->post())){
            $model->fkevent = $fkevent;
            $model->fechaing = new Expression('NOW()');
            $model->estado = "P";
            // devuelve un array de imagenes
            $images = $model->uploadImage();

            // multiple archivos
            $filesCount = count($images);
            yii::warning("fileCount : " . $filesCount);

            for ($i=0; $i < $filesCount; $i++) {
                $mImg = new Simgevent();
                $mImg->fkevent = $fkevent;
                $mImg->fechaing = new Expression('NOW()');
                $mImg->estado = "P";
                // Camino donde se guardara las imagenes
                $path = Yii::getAlias('@webroot').
                        Yii::$app->params['uploadEvents'].
                        $mImg->fkevent . '/';

                yii::warning("file : " . $images[$i]);
                $img = $images[$i];
                
                // obtenemos la extension
                $ext = end((explode(".", $images[$i]->name)));
                $ext = strtolower($ext);
                // generamos un nombre aleatorio de 20 caracteres
                $mImg->path = Yii::$app
                                    ->security
                                    ->generateRandomString(20).".{$ext}";
                Yii::warning("[path: " . $mImg->path . '] [fkevent : ' . $mImg->fkevent);
                // aqui es donde guardaremos las imagenes
                if($mImg->save()){
                    if($img !== false){
                        // creamos el directorio
                        FileHelper::createDirectory($path);
                        $path = $path . $mImg->path;
                        Yii::warning('camino : ' . $path);

                        $img->saveAs($path);
                    }
                }
            
            }
            return $this->redirect(
                        [
                            'index', 
                            'fkevent' => $fkevent]);
        }else{
            return $this->render('create', ['model' => $model]);
        }
    }


    /**
     * Deletes an existing Simgevent model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        
        $model = $this->findModel($id);

        // segundo obtenemos el modelo evento social
        $moEvento = Seventosocial::findOne(['pkevento' => $model->fkevent]);
        if(isset($model)){ // variable definida
            $path = Yii::getAlias('@webroot').
                    Yii::$app->params['uploadEvents'].
                    $model->fkevent . '/'. 
                    $model->path;

            Yii::warning("eliminado la imagen evento: " . $path);
            @unlink($path);
            $model->delete();
        }

        return $this->redirect([
                                'index', 
                                'fkevent' => $model->fkevent, 
                                'data' => $moEvento->sdescripcion,
                                ]);
    }

    /**
     * Finds the Simgevent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Simgevent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Simgevent::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
