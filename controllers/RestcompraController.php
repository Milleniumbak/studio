<?php 
namespace app\controllers;

use yii\rest\ActiveController;

use app\models\Scompra;
use app\models\Sdimension;
use app\models\Stipopapel;

use yii\db\Expression;
use yii\helpers\Json;

/**
*  rest de imagen de eventos
*/
class RestcompraController extends ActiveController{
	
	public $modelClass = "app\models\Scompra";
	
	// para hacer llamadas en modo pretty usar una s al final del controlador
	// http://192.168.1.5/studio/web/restimgevents/getimages/1  < fijarse la s del controlador 

	/**
	 * Metodo que devuelve una lista de dimensiones
	 * que son de un evento
	 * @param  [type] $pkevent identificador de evento
	 * @return [type] Lista de imagenes          
	 */
	public function actionGetdimensiones(){

		$response = null;
		$models = null;		

		$models  = Sdimension::find()
					->asArray()
					->all();

        if($models == null){
            $response = array('resultado' => "error");	
        }else{
            $response = array('resultado' => "ok", "modelo" => $models);
        }
            
		return $response;
	}

	public function actionGettipopapeles(){

		$response = null;
		$models = null;		

		$models  = Stipopapel::find()
					->asArray()
					->all();

        if($models == null){
            $response = array('resultado' => "error");	
        }else{
            $response = array('resultado' => "ok", "modelo" => $models);
        }
            
		return $response;
	}

}
?>