<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "scompra".
 *
 * @property integer $pkcompra
 * @property integer $fkusuario
 * @property integer $fkimgevent
 * @property integer $cantidad
 * @property string $precio
 * @property integer $fktipopapel
 * @property integer $fkdimension
 * @property integer $tipocompra
 *
 * @property Sdimension $fkdimension0
 * @property Simgevent $fkimgevent0
 * @property Stipopapel $fktipopapel0
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
            [['fkusuario', 'fkimgevent', 'cantidad', 'precio', 'tipocompra'], 'required'],
            [['fkusuario', 'fkimgevent', 'cantidad', 'fktipopapel', 'fkdimension', 'tipocompra'], 'integer'],
            [['precio'], 'number'],
            [['fkdimension'], 'exist', 'skipOnError' => true, 'targetClass' => Sdimension::className(), 'targetAttribute' => ['fkdimension' => 'pkdimension']],
            [['fkimgevent'], 'exist', 'skipOnError' => true, 'targetClass' => Simgevent::className(), 'targetAttribute' => ['fkimgevent' => 'pkimgevent']],
            [['fktipopapel'], 'exist', 'skipOnError' => true, 'targetClass' => Stipopapel::className(), 'targetAttribute' => ['fktipopapel' => 'pktipopapel']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pkcompra' => 'Pkcompra',
            'fkusuario' => 'Fkusuario',
            'fkimgevent' => 'Fkimgevent',
            'cantidad' => 'Cantidad',
            'precio' => 'Precio',
            'fktipopapel' => 'Fktipopapel',
            'fkdimension' => 'Fkdimension',
            'tipocompra' => 'Tipocompra',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkdimension0()
    {
        return $this->hasOne(Sdimension::className(), ['pkdimension' => 'fkdimension']);
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
    public function getFktipopapel0()
    {
        return $this->hasOne(Stipopapel::className(), ['pktipopapel' => 'fktipopapel']);
    }
}
