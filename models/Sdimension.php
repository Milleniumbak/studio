<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sdimension".
 *
 * @property integer $pkdimension
 * @property string $codigo
 * @property string $descripcion
 * @property string $precio
 *
 * @property Scompraimpresa[] $scompraimpresas
 */
class Sdimension extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sdimension';
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
            'pkdimension' => 'Pkdimension',
            'codigo' => 'Codigo',
            'descripcion' => 'Dimension',
            'precio' => 'Precio',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScompraimpresas()
    {
        return $this->hasMany(Scompraimpresa::className(), ['fkdimension' => 'pkdimension']);
    }
}
