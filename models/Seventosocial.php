<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "seventosocial".
 *
 * @property integer $pkevento
 * @property string $sdescripcion
 * @property string $sdireccion
 * @property string $sfecha
 * @property string $stelefono
 * @property string $sestado
 * @property string $smensaje
 * @property string $path
 * @property integer $fkusuario
 *
 * @property Senvio[] $senvios
 * @property Simgevent[] $simgevents
 * @property Simgqr[] $simgqrs
 */
class Seventosocial extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seventosocial';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sfecha'], 'safe'],
            [['sfecha'], 'required'],

            [['sdescripcion', 'sdireccion', 'smensaje'], 'string', 'max' => 50],
            [['sdescripcion', 'sdireccion', 'smensaje'], 'required'],

            [['smensaje'], 'string', 'min' => 20],
            
            [['stelefono'], 'string', 'max' => 15],
            
            [['path'], 'string', 'max' => 25],

            [['sestado'], 'string', 'max' => 1],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pkevento' => 'Identificador de evento',
            'sdescripcion' => 'Descripcion del evento',
            'sdireccion' => 'Direccion del evento',
            'sfecha' => 'Fecha de realizacion',
            'stelefono' => 'Telefono de contacto',
            'sestado' => 'Estado del evento',
            'smensaje' => 'Datos para el QR'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSenvios()
    {
        return $this->hasMany(Senvio::className(), ['fkevento' => 'pkevento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSimgevents()
    {
        return $this->hasMany(Simgevent::className(), ['fkevent' => 'pkevento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSimgqrs()
    {
        return $this->hasMany(Simgqr::className(), ['fkevento' => 'pkevento']);
    }
}
