<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "susuario".
 *
 * @property integer $pkusuario
 * @property string $snombre
 * @property string $sapellido
 * @property string $semail
 * @property string $stelefono
 * @property string $spassword
 * @property integer $stipousuario
 * @property string $sestado
 * @property string $username
 * @property string $authkey
 * @property string $accesstoken
 *
 * @property Senvio[] $senvios
 * @property Simgusuario[] $simgusuarios
 * @property Sscanner[] $sscanners
 */
class Susuario extends \yii\db\ActiveRecord
{
    public $password_repeat;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'susuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['stipousuario'], 'integer'],

            [['snombre', 'sapellido'], 'string', 'max' => 50],

            [['semail'], 'string', 'max' => 25],
            [['semail'], 'email'],
            [['semail'], 'required'],

            [['stelefono'], 'string', 'max' => 15],

            [['sestado'], 'string', 'max' => 1],

            [['username'], 'string', 'max' => 25],
            [['username'], 'string', 'min' => 6],
            [['username'], 'required'],

            [['authkey'], 'string', 'max' => 50],

            [['accesstoken'], 'string', 'max' => 50],

            [['spassword'], 'required'],
            [['spassword'], 'string', 'max' => 50],
            [['spassword'], 'string', 'min' => 6],

            [['password_repeat'], 'required'],
            ['password_repeat', 'compare', 'compareAttribute'=>'spassword', 'skipOnEmpty' => false, 'message'=>"Contraseñas diferentes!!"],


        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pkusuario' => 'Identificador primario',
            'snombre' => 'Nombre Completo',
            'sapellido' => 'Apellidos Completos',
            'semail' => 'Correo Electronico',
            'stelefono' => 'Telefono',
            'spassword' => 'Contraseña',
            'stipousuario' => 'Tipo de suscripcion',
            'sestado' => 'Estado',
            'password_repeat' => 'Repita contraseña',
            'username'  => 'Nombre de usuario',
            'authkey'   => 'llave de autorizacion',
            'accesstoken' => 'Token de Acceso',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSenvios()
    {
        return $this->hasMany(Senvio::className(), ['fkusuario' => 'pkusuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSimgusuarios()
    {
        return $this->hasMany(Simgusuario::className(), ['fkusuario' => 'pkusuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSscanners()
    {
        return $this->hasMany(Sscanner::className(), ['fkusuario' => 'pkusuario']);
    }
}
