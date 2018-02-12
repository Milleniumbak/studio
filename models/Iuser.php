<?php
namespace app\models;

use app\models\Gusuario;
use \yii\web\IdentityInterface;

class Iuser implements IdentityInterface
{
    # actualizacion de interfaz de usuario
    public $usuario;

    public function __construct(){

    }
    // implementaciones de la interface --------------------------------
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        // tengo que por identificador en la BD
        //return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
        $usr = Cusuario::findOne(['pkusuario' => $id]);
        $iusr = new Iuser();

        if(!is_null($usr)){
            $iusr->usuario = $usr;
            return $iusr;
        }else{
            return null;
        }
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $usr = Csuser::findOne(['accesstoken' => $token]);

        $iusr = new Iuser();
        if(!is_null($usr)){
            $iusr->usuario = $usr;
            return $iusr;
        }else{
            return null;
        }
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->usuario->pkuser;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->usuario->authkey;
    }

    /**
     * Devuelve el nombre de usuario
     * @return [String] Nombre de usuario
     */
    public function getUsername(){
        return $this->usuario->nickname;
    }
    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->usuario->authkey === $authKey;
    }

    /**
     * validacion de contraseña
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->usuario->password === $password;
    }
}