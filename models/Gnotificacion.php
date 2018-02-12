<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gnotificacion".
 *
 * @property int $pkNotificacion
 * @property string $codigo
 * @property string $codigoSol
 * @property string $titulo
 * @property string $cuerpo
 * @property string $estado
 * @property string $fecha
 * @property int $fkusuario
 *
 * @property Gusuario $fkusuario0
 */
class Gnotificacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gnotificacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha'], 'safe'],
            [['fkusuario'], 'default', 'value' => null],
            [['fkusuario'], 'integer'],
            [['codigo', 'codigoSol'], 'string', 'max' => 20],
            [['titulo'], 'string', 'max' => 50],
            [['cuerpo'], 'string', 'max' => 100],
            [['estado'], 'string', 'max' => 20],
            [['fkusuario'], 'exist', 'skipOnError' => true, 'targetClass' => Gusuario::className(), 'targetAttribute' => ['fkusuario' => 'pkusuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pkNotificacion' => 'Pk Notificacion',
            'codigo' => 'Codigo',
            'codigoSol' => 'Codigo Sol',
            'titulo' => 'Titulo',
            'cuerpo' => 'Cuerpo',
            'estado' => 'Estado',
            'fecha' => 'Fecha',
            'fkusuario' => 'Fkusuario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkusuario0()
    {
        return $this->hasOne(Gusuario::className(), ['pkusuario' => 'fkusuario']);
    }
}
