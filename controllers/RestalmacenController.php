<?php 
namespace app\controllers;
use yii\rest\ActiveController;
use yii\db\Expression;
use app\models\Gusuario;
use app\models\Gnotificacion;
use app\models\Sautorizacion;

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
	/**
	 * metodo que busca las notificaciones
	 *
	 * @param [type] $fkusuario llave del usuario 
	 * @return void
	 */
	public function actionGetnotificaciones($fkusuario){
		$notis = Gnotificacion::find()
						->where(["fkusuario" => $fkusuario])
						->asArray()
						->all();

		if(count($notis) <= 0){
			return array('resultado' => "-1");
		}else{
			return array('resultado' => "ok", "data"=> $notis);
		}
	}

	/**
	 * Servicio que registra el token del telefono movil
	 *
	 * @param [type] $token
	 * @param [type] $idusuario
	 * @param [type] $topic
	 * @param [type] $imei_device
	 * @return void
	 */
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