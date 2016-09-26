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
            [['sdescripcion', 'sdireccion'], 'string', 'max' => 50],
            [['stelefono'], 'string', 'max' => 15],
            [['sestado'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pkevento' => 'Pkevento',
            'sdescripcion' => 'Sdescripcion',
            'sdireccion' => 'Sdireccion',
            'sfecha' => 'Sfecha',
            'stelefono' => 'Stelefono',
            'sestado' => 'Sestado',
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
