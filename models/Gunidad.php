<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gunidad".
 *
 * @property int $pkunidad
 * @property string $codigo
 * @property string $descripcion
 */
class Gunidad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gunidad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo'], 'string', 'max' => 4],
            [['descripcion'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pkunidad' => 'Pkunidad',
            'codigo' => 'Unidad',
            'descripcion' => 'Unidad',
        ];
    }
}
