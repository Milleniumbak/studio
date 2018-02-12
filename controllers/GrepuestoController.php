<?php

namespace app\controllers;

use Yii;
use app\models\Grepuesto;
use app\models\GrepuestoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Ggrupo;
use app\models\Gsubgrupo;
use app\models\Gfabricante;
use app\models\Gsistema;
use app\models\Gmodelo;

/**
 * GrepuestoController implements the CRUD actions for Grepuesto model.
 */
class GrepuestoController extends Controller
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
     * Metodo que devuelve el codigo de grupo
     *
     * @param [type] $id identificador de grupo
     * @return void
     */
    public function actionGetcodgrupo($id){        
        $grupo = Ggrupo::findOne(['pkgrupo' => $id]);
        
        echo json_encode(["codigo" => $grupo->codigo]);
    }

    public function actionGetcodsubgrupo($id){
        $sgrupo = Gsubgrupo::findOne(['pksubgrupo' => $id]);
        echo json_encode(["codigo" => $sgrupo->codigo ]);
    }

    public function actionGetcodfabricante($id){
        $fabricante = Gfabricante::findOne(['pkfrabrica' => $id]);
        echo json_encode(["codigo" => $fabricante->codigo]);
    }

    public function actionGetcodmodelo($id){
        $modelo = Gmodelo::findOne(['pkmodelo' => $id]);
        echo json_encode(["codigo" => $modelo->codigo]);
    }

    public function actionGetcodsistema($id){
        $sistema = Gsistema::findOne(['pksistema' => $id]);
        echo json_encode(["codigo" => $sistema->codigo]);
    }


    /**
     * Lists all Grepuesto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GrepuestoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Grepuesto model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Grepuesto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Grepuesto();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pkarticulo]);
        }
        $model->codigo_completo = "AA-BB-CCC-DDD-EE";
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Grepuesto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pkarticulo]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Grepuesto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Grepuesto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Grepuesto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Grepuesto::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
