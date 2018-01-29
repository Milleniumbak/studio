<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sautorizacion".
 *
 * @property string $token
 * @property string $topic
 * @property string $imei_device
 * @property integer $fkusuario
 * @property string $fecha_registro
 */
class Sautorizacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sautorizacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['token', 'topic', 'imei_device', 'fkusuario', 'fecha_registro'], 'required'],
            [['fkusuario'], 'integer'],
            [['fecha_registro'], 'safe'],
            [['token'], 'string', 'max' => 155],
            [['topic', 'imei_device'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'token' => 'Token',
            'topic' => 'Topic',
            'imei_device' => 'Imei Device',
            'fkusuario' => 'Fkusuario',
            'fecha_registro' => 'Fecha Registro',
        ];
    }
}
