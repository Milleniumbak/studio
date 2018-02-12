<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gusuario".
 *
 * @property int $pkusuario
 * @property string $nombre_usuario
 * @property string $nombrecomp
 * @property string $apellidocomp
 * @property string $password
 * @property string $email
 * @property string $authkey
 * @property string $accesstoken
 * @property string $estado
 *
 * @property Gnotificacion[] $gnotificacions
 * @property Gsolicitud[] $gsolicituds
 */
class Gusuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gusuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_usuario', 'password', 'email'], 'string', 'max' => 25],
            [['nombrecomp', 'apellidocomp', 'authkey', 'accesstoken'], 'string', 'max' => 50],
            [['estado'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pkusuario' => 'Pkusuario',
            'nombre_usuario' => 'Nombre de Usuario',
            'nombrecomp' => 'Nombrecomp',
            'apellidocomp' => 'Apellidocomp',
            'password' => 'Password',
            'email' => 'Email',
            'authkey' => 'Authkey',
            'accesstoken' => 'Accesstoken',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGnotificacions()
    {
        return $this->hasMany(Gnotificacion::className(), ['fkusuario' => 'pkusuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGsolicituds()
    {
        return $this->hasMany(Gsolicitud::className(), ['fkusuario' => 'pkusuario']);
    }
}
