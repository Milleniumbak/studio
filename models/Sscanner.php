<?php

namespace app\models;

use Yii;

/**
 * Este es el modelo de la galeria class for table "sscanner".
 *
 * @property integer $pkscanner
 * @property integer $fkusuario
 * @property integer $fkimgevent
 * @property string $estado
 * @property string $fechaing
 *
 * @property Simgevent $fkimgevent0
 * @property Susuario $fkusuario0
 */
class Sscanner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sscanner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fkusuario', 'fkimgevent'], 'integer'],
            [['fechaing'], 'safe'],
            [['estado'], 'string', 'max' => 1],
            [['fkimgevent'], 'exist', 'skipOnError' => true, 'targetClass' => Simgevent::className(), 'targetAttribute' => ['fkimgevent' => 'pkimgevent']],
            [['fkusuario'], 'exist', 'skipOnError' => true, 'targetClass' => Susuario::className(), 'targetAttribute' => ['fkusuario' => 'pkusuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pkscanner' => 'Identificador primario',
            'fkusuario' => 'Usuario',
            'fkimgevent' => 'Fotografia',
            'estado' => 'Estado',
            'fechaing' => 'Fecha de Subida',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkimgevent0()
    {
        return $this->hasOne(Simgevent::className(), ['pkimgevent' => 'fkimgevent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkusuario0()
    {
        return $this->hasOne(Susuario::className(), ['pkusuario' => 'fkusuario']);
    }
}
