<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stipopapel".
 *
 * @property integer $pktipopapel
 * @property string $codigo
 * @property string $descripcion
 * @property string $precio
 *
 * @property Scompraimpresa[] $scompraimpresas
 */
class Stipopapel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stipopapel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['precio'], 'number'],
            [['codigo'], 'string', 'max' => 25],
            [['descripcion'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pktipopapel' => 'Pktipopapel',
            'codigo' => 'Codigo',
            'descripcion' => 'Tipo de papel',
            'precio' => 'Precio',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScompraimpresas()
    {
        return $this->hasMany(Scompraimpresa::className(), ['fktipopapel' => 'pktipopapel']);
    }
}
