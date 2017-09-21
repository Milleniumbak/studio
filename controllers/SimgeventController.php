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
use yii\imagine\Image;
use app\models\Srestgoogledrive;
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
     * Mostramos un modelo .
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
     * Metodo que se utiliza cuando hay autenticacion con el servidor en la nube
     * Aqui es donde llegan las respuestas de las credenciales
     * **/
    public function actionOauthocallback(){
        # metodo que se ejecuta cuando no hay credenciales
        # direccion de respuesta
        # localhost/web/index.php?r=simgevent/oauthocallback
        
        $rGoogle = new Srestgoogledrive();
        $url = $rGoogle->oauth_callback();
        if(!is_null($url)){
            return $this->redirect($url, 302);
        }        
        //continuamos con la suida de las imagenes
        return $this->goHome();
    }

    /**
     * crea un nuevo modelo de Simgevent.
     * Si la creacion es exitosa, el navegador sera direccionado a la pagina view.
     * @return mixed
     */
    public function actionCreate($fkevent)
    {
        $idKeyImage = null;
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
                $mImg->estado = "P"; #mi imagen subida sin procesar
                
                # obtenemos la imagen de la lista
                $img = $images[$i];
                
                // obtenemos la extension
                $tmp = (explode(".", $images[$i]->name));
                $ext = end($tmp);
                $ext = strtolower($ext);
                // generamos un nombre aleatorio de 20 caracteres
                $mImg->path = Yii::$app
                                    ->security
                                    ->generateRandomString(20).".{$ext}";
                
                if($img !== false){
                    #Ahora subimos al servidor
                    $mImg->idimagecloud = $this->upload_image_to_Cloud($fkevent, $img->tempName, $mImg->path, $img->type);
                    $mImg->save();
                    # verificar la marca de agua
                    # $this->createMarcaAgua($camino, $mImg->path);
                }                
            }
            //return $this->render('connect', ["data" =>"ID de carpeta encontrada $data"]);
            return $this->redirect(
                        ['index', 'fkevent' => $fkevent]);
        }else{
            return $this->render('create', ['model' => $model]);
        }
    }
    /** 
     * Metodo que carga sube una iamgen a la nube
     * @param $fkEvent Llave primaria del evento que es el nombre de la carpeta. 
     * @param $file_path Ruta donde esta ubicado el archivo
     * @param $name Es el nuevo nombre de la imagen con el que se subira a la nube
     * @param $mimeType Es el mime type del archivo que se subira a la nube
     */
    private function upload_image_to_Cloud($fkEvent, $file_path, $name, $mimeType){
        $rGoogle = new Srestgoogledrive();
        $client = $rGoogle->connect_to_cloud();
        if(!is_null($client)){
            # buscamos si ya tenemos la carpeta del evento
            $idSearch = $rGoogle->searchFolder($client, "e".$fkEvent);
            $idFile   = null;
            if(is_null($idSearch)){
                # 0B2xwIp-Xlx0dQ1hBZzY5LV9heGc  events
                # 0B2xwIp-Xlx0dR2dJcHowYzdRaVU faces
                # Creamos el directorio en la nube dentro de la carpeta events
                $idFile = $rGoogle->createDirectory($client, "e".$fkEvent, "0B2xwIp-Xlx0dQ1hBZzY5LV9heGc");
                Yii::Warning("ide folder creado $idFile");
                $idSearch = $idFile;
            }
        
            $rGoogle->uploadFileBig($file_path, $client, $name, "desde yii2", $mimeType, $idSearch);
            $idImage = $rGoogle->searchImage($client, $name);

            return $idImage;
        }else{
            $this->redirect(["site/login"]);
        }
    }
    /**
     * @param $path es la ubicacion de la imagen
     */
    private function createMarcaAgua($path, $name){
        //Yii::$app->params['imgWatermark']
        // generamos imagen en miniatura
        //Image::thumbnail($path . $name, 120, 120)
        //     ->save($path . 'thumb-' .$name , ['quality' => 50]);

        # adicionamos marca de agua a la fotografia
        Image::watermark(   $path . $name,
                            Yii::getAlias('@webroot') . Yii::$app->params['imgWatermark'],
                            [0, 0])
            ->save($path . 'water-' .$name);
    }
    // esto de abajo se modifico en la api imagine, asi que modificarlo como esto
    // public static function watermark($filename, $watermarkFilename, array $start = [0, 0])
    // {
    //     if (!isset($start[0], $start[1])) {
    //         throw new InvalidParamException('$start must be an array of two elements.');
    //     }
    //     $img = static::getImagine()->open(Yii::getAlias($filename));
    //     $watermark = static::getImagine()->open(Yii::getAlias($watermarkFilename));
    //     // se aumentaron estas dos lineas para la marca de agua mas grande
    //     $size      = $img->getSize();
    //     $watermark->resize(new Box($size->getWidth(), $size->getHeight()));
    //
    //     $img->paste($watermark, new Point($start[0], $start[1]));
    //     return $img;
    // }

    /**
     * Deletes an existing Simgevent model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $rGoogle = new Srestgoogledrive();
        // segundo obtenemos el modelo evento social
        $moEvento = Seventosocial::findOne(['pkevento' => $model->fkevent]);
        if(isset($model)){
            $client = $rGoogle->connect_to_cloud();
            #eliminamos el archivo
            $rGoogle->deleteFile($client, $model->idimagecloud);
            #eliminamos de la base de datos
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
