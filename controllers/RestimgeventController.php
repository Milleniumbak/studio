<?php 
namespace app\controllers;

use yii\rest\ActiveController;
use app\models\Simgevent;
use yii\db\Expression;
use yii\helpers\Json;

/**
*  rest de imagen de eventos
*/
class RestimgeventController extends ActiveController{
	
	public $modelClass = "app\models\Simgevent";
	
	// para hacer llamadas en modo pretty usar una s al final del controlador
	// http://192.168.1.5/studio/web/restimgevents/getimages/1  < fijarse la s del controlador 

	/**
	 * Metodo que devuelve una lista de imagenes
	 * que son de un evento
	 * @param  [type] $pkevent identificador de evento
	 * @return [type] Lista de imagenes          
	 */
	public function actionGetimages($pkevent){

		$response = null;
		$models = null;
		$imagenes = Array();
		if($pkevent > 0){
			$models = Simgevent::find()
						->where(["fkevent"=>$pkevent])
						->asArray()
						->all();
		}else{
			$models  = Simgevent::find()
						->asArray()
						->all();
        }

        if($models == null){
            $response = array('resultado' => "error");	
        }else{
            $response = array('resultado' => "ok", "modelo" => $models);
        }
            
		return $response;
	}
}
?>