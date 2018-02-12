<?php 
namespace app\controllers;
use yii\rest\ActiveController;
use yii\db\Expression;
use app\models\Gusuario;


class RestalmacenController extends ActiveController{
	
	public $modelClass = "app\models\Ggrupo";

	// para hacer llamadas en modo pretty usar una s al final del controlador
	// http://192.168.1.5/studio/web/restimgevents/getimages/1  < fijarse la s del controlador 
	/**
	 * Metodo que autentifica al usuario en el servidor
	 * @param  [type] $username [description]
	 * @param  [type] $password [description]
	 * @return [type]           [description]
	 */
	public function actionAutenticacion($username, $password){
		$user = null;		
		$resultado = -1;
		$user = Gusuario::find()->where(["nombre_usuario" =>$username])->one();
		if(!is_null($user)){
			if($user->password == $password){
				$resultado = $user->pkusuario;
			}else{
				$resultado = -1;
			}
		}else{
			$resultado = -1;
		}
		$response = array('resultado' => $resultado);		
		return $response;
	}
	public 
}
?>