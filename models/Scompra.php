<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "scompra".
 *
 * @property integer $pkcompra
 * @property string $fecha
 * @property integer $fkusuario
 * @property integer $fkevent
 *
 * @property Seventosocial $fkevent0
 * @property Susuario $fkusuario0
 */
class Scompra extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scompra';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha', 'fkusuario', 'fkevent'], 'required'],
            [['fecha'], 'safe'],
            [['fkusuario', 'fkevent'], 'integer'],
            [['fkevent'], 'exist', 'skipOnError' => true, 'targetClass' => Seventosocial::className(), 'targetAttribute' => ['fkevent' => 'pkevento']],
            [['fkusuario'], 'exist', 'skipOnError' => true, 'targetClass' => Susuario::className(), 'targetAttribute' => ['fkusuario' => 'pkusuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pkcompra' => 'Pkcompra',
            'fecha' => 'Fecha',
            'fkusuario' => 'Fkusuario',
            'fkevent' => 'Fkevent',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkevent0()
    {
        return $this->hasOne(Seventosocial::className(), ['pkevento' => 'fkevent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkusuario0()
    {
        return $this->hasOne(Susuario::className(), ['pkusuario' => 'fkusuario']);
    }
}
