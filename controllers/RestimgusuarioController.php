<?php 
namespace app\controllers;

use yii\rest\ActiveController;
use app\models\Simgusuario;
use yii\db\Expression;
use yii\helpers\Json;

/**
*  rest de imagen de usuario
*/
class RestimgusuarioController extends ActiveController{
	
	public $modelClass = "app\models\Simgusuario";

	/**
	 * Metodo que devuelve los datos de la imagen a partir
	 * del identificador primario del usuario
	 * @param  [type] $pkusuario identificador de usuario
	 * @return [type]          
	 */
	public function actionGetimage($pkusuario){
		$response = null;
		
		if($pkusuario > 0){ // pkusuaio  = 1
			$model = Simgusuario::findOne(["fkusuario"=>$pkusuario]);
			
			if($model == null){
				$response = array('resultado' => "error");	
			}else{
				$response = array('resultado' => "ok", "modelo" => $model);
			}
		}else{
			$response = array('resultado' => "error");
		}
		
		return $response;
	}
	/**
	 * Metodo que guardar un usuario al servidor
	 * @param  [type] $pkimgusuario [description]
	 * @param  [type] $fkusuario    [description]
	 * @param  [type] $path         [description]
	 * @param  [type] $idimagecloud [description]
	 * @return [type]               [description]
	 */
	public function actionAdicionar($pkimgusuario, $fkusuario, $path, $idimagecloud){

		$response = null;
		$model = new Simgusuario();
		
		if($pkimgusuario > 0){
			$model = Simgusuario::findOne($pkimgusuario);
			$model->fkusuario = $fkusuario;
			$model->path = $path;
			$model->estado = "P";
			$model->fechaing = new Expression('NOW()');
			$model->idimagecloud = $idimagecloud;			
		}else{
			$model->fkusuario = $fkusuario;
			$model->path = $path;
			$model->estado = "P";
			$model->fechaing = new Expression('NOW()');
			$model->idimagecloud = $idimagecloud;
		}
		
		if($model->save()){
			$response = array('resultado' => "ok");
		}else{
			$response = array('resultado' => "error");
		}
		
		return json_encode($response);
	}
}
?>