<?php 
namespace app\controllers;

use yii\rest\ActiveController;
use app\models\Susuario;
use app\models\Sautorizacion;
use yii\db\Expression;
/**
* restusuarios
*/
class RestusuarioController extends ActiveController{
	
	public $modelClass = "app\models\Susuario";

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

	
	public function actionRegistrartoken($token, $idusuario, $topic, $imei_device){
		
		$aut = Sautorizacion::find()->where(["token"=>$token])->one();

		if(is_null($aut)){
			$aut = new Sautorizacion();
		}
		
		$aut->token = $token;
		$aut->topic = $topic;
		$aut->fkusuario = $idusuario;
		$aut->imei_device = $imei_device;
		$aut->fecha_registro = new Expression('NOW()');
		
		$aut->save();

		$response = array('resultado' => "token guardado correctamente");
		
		return $response;

	}
}
?>