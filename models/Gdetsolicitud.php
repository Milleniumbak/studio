<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gdetsolicitud".
 *
 * @property int $pkdetsolicitud
 * @property int $fksolicitud
 * @property int $item
 * @property int $fkrepuesto
 * @property int $cantidad
 * @property string $estado
 *
 * @property Grepuesto $fkrepuesto0
 * @property Gsolicitud $fksolicitud0
 */
class Gdetsolicitud extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gdetsolicitud';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fksolicitud', 'item', 'fkrepuesto', 'cantidad'], 'default', 'value' => null],
            [['fksolicitud', 'item', 'fkrepuesto', 'cantidad'], 'integer'],
            [['estado'], 'string', 'max' => 1],
            [['fkrepuesto'], 'exist', 'skipOnError' => true, 'targetClass' => Grepuesto::className(), 'targetAttribute' => ['fkrepuesto' => 'pkarticulo']],
            [['fksolicitud'], 'exist', 'skipOnError' => true, 'targetClass' => Gsolicitud::className(), 'targetAttribute' => ['fksolicitud' => 'pksolicitud']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pkdetsolicitud' => 'Pkdetsolicitud',
            'fksolicitud' => 'Fksolicitud',
            'item' => 'Item',
            'fkrepuesto' => 'Fkrepuesto',
            'cantidad' => 'Cantidad',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkrepuesto0()
    {
        return $this->hasOne(Grepuesto::className(), ['pkarticulo' => 'fkrepuesto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFksolicitud0()
    {
        return $this->hasOne(Gsolicitud::className(), ['pksolicitud' => 'fksolicitud']);
    }
}
