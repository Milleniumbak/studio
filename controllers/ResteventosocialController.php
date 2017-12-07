<?php 
namespace app\controllers;

use yii\rest\ActiveController;

/**
* resteventosocial
*/
class ResteventosocialController extends ActiveController{
	
	public $modelClass = "app\models\Seventosocial";


	public function actionGuest($id){
		return json_encode("Mi id de evento es : " . $id);
	}
}
?>