<?php

namespace app\controllers;

use Yii;
use app\models\Simgusuario;
use app\models\SimgusuarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\db\Expression;
use yii\helpers\FileHelper;
/**
 * SimgusuarioController implements the CRUD actions for Simgusuario model.
 */
class SimgusuarioController extends Controller
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
     * Lista todas las imagenes del usuario
     * @return mixed
     */
    public function actionIndex($pkusuario)
    {
        $searchModel = new SimgusuarioSearch();
        $dataProvider = $searchModel
                            ->search(Yii::$app->request->queryParams, $pkusuario);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Simgusuario model.
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
     * Creates a new Simgusuario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new Simgusuario();

        if($model->load(Yii::$app->request->post())){
            //obtenemos la imagen que nos llega
            $image = UploadedFile::getInstance($model, 'image');
            
            // obtenemos la extension
            $ext = end((explode(".", $image->name)));
            Yii::warning("nombre  : " . $image->name);


            $model->fkusuario = Yii::$app->user->identity->getId();
            // generamos un nombre aleatorio de 20 caracteres
            $model->path = Yii::$app->security->generateRandomString(20).".{$ext}";
            
            $model->fechaing = new Expression('NOW()');
            // Camino donde se guardara la imagen
            $path = Yii::getAlias('@webroot').
                    Yii::$app->params['uploadFaces'].
                    $model->fkusuario . '/';
                    

            // creamos el directorio
            FileHelper:: createDirectory($path);

            $path = $path . $model->path;

            Yii::warning("Pase : " . $path);
            Yii::warning("model path : " . $model->path);

            if($model->save()){
                $image->saveAs($path);
                Yii::warning("se guardo correctamente: ");
                return $this->redirect(['view', 'id'=>$model->pkimgusuario]);
            }else{
                // Error al guardar la imagen
                Yii::warning("Error al guardar archivo : " . $path);
            }

        }else{
            return $this->render('create', ['model' => $model]);
        }
    }

    /**
     * Deletes an existing Simgusuario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //$model = $this->findModel($id);
        $model = Simgusuario::findOne(['pkimgusuario' => $id]);
        if(isset($model)){ // variable definida
            $path = Yii::getAlias('@webroot').
                    Yii::$app->params['uploadFaces'].
                    $model->fkusuario . '/'. 
                    $model->path;

            Yii::warning("path a eliminar : " . $path);
            @unlink($path);
            $model->delete();
        }

        return $this->redirect(['index', 'pkusuario' => Yii::$app->user->identity->getId()]);
    }

    /**
     * Finds the Simgusuario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Simgusuario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Simgusuario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Imagen no encontrada!!!!');
        }
    }
}
