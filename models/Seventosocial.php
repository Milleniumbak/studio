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
 * @property integer $fktipoevento
 * @property numeric sprecioxfoto
 * @property Senvio[] $senvios
 * @property Simgevent[] $simgevents
 * @property Simgqr[] $simgqrs
 * @property Stipoevento $fktipoevento0
 * @property Susuario $fkusuario0
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

            [['sprecioxfoto'], "number"],

            [['sdescripcion', 'sdireccion', 'smensaje'], 'string', 'max' => 50],
            [['sdescripcion', 'sdireccion', 'smensaje'], 'required'],

            [['smensaje'], 'string', 'min' => 20],

            [['stelefono'], 'string', 'max' => 15],

            [['path'], 'string', 'max' => 25],

            [['sestado'], 'string', 'max' => 1],

            [['fktipoevento'], 'exist', 'skipOnError' => true, 'targetClass' => Stipoevento::className(), 'targetAttribute' => ['fktipoevento' => 'pktipoevento']],

            [['fkusuario'], 'exist', 'skipOnError' => true, 'targetClass' => Susuario::className(), 'targetAttribute' => ['fkusuario' => 'pkusuario']],
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
            'smensaje' => 'Datos para el QR',
            'fktipoevento' => 'Tipo de evento social',
            'sprecioxfoto' => 'Precio por fotografia (Bs.-)',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSenvios()
    {
        return $this->hasMany(Senvio::className(), ['fkevento' => 'pkevento']);
    }

    public function getFktipoevento0(){
        return $this->hasOne(Stipoevento::className(), ['pktipoevento' => 'fktipoevento']);
    }

    public function getFkusuario0(){
      return $this->hasOne(Susuario::className(), ['pkusuario' => 'fkusuario']);
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
