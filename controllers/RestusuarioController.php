<?php 
namespace app\controllers;

use yii\rest\ActiveController;
use app\models\Susuario;
/**
* restusuarios
*/
class RestusuarioController extends ActiveController{
	
	public $modelClass = "app\models\Susuario";

	/**
	 * Metodo que autentifica al usuario en el servidor
	 * @param  [type] $username [description]
	 * @param  [type] $password [description]
	 * @return [type]           [description]
	 */
	public function actionAutenticacion($username, $password){
		$user = null;		
		$resultado = -1;
		$user = Susuario::find()->where(["username" =>$username])->one();
		if(!is_null($user)){
			if($user->spassword == $password){
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
}
?>