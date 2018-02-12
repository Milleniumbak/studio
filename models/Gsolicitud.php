<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gsolicitud".
 *
 * @property int $pksolicitud
 * @property string $fecha
 * @property string $fecha_req
 * @property string $glosa
 * @property int $fkusuario
 * @property string $estado

 * @property Gdetsolicitud[] $gdetsolicituds
 * @property Gusuario $fkusuario0
 */
class Gsolicitud extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gsolicitud';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha', 'fecha_req'], 'safe'],
            [['fecha', 'fecha_req', 'fkusuario', 'estado'], 'required'],
            [['fkusuario'], 'default', 'value' => null],
            [['fkusuario'], 'integer'],
            [['glosa'], 'string', 'max' => 50],
            [['fkusuario'], 'exist', 'skipOnError' => true, 'targetClass' => Gusuario::className(), 'targetAttribute' => ['fkusuario' => 'pkusuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pksolicitud' => 'Codigo',
            'fecha' => 'Fecha',
            'fecha_req' => 'Fecha Requerida',
            'glosa' => 'Glosa',
            'fkusuario' => 'Usuario',
            'estado' => "Estado de Solicitud",
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGdetsolicituds()
    {
        return $this->hasMany(Gdetsolicitud::className(), ['fksolicitud' => 'pksolicitud']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkusuario0()
    {
        return $this->hasOne(Gusuario::className(), ['pkusuario' => 'fkusuario']);
    }
}
