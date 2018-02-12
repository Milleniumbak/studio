<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gubicacion".
 *
 * @property int $pkubicacion
 * @property string $codigo
 * @property string $descripcion
 */
class Gubicacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gubicacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo'], 'string', 'max' => 10],
            [['descripcion'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pkubicacion' => 'Pkubicacion',
            'codigo' => 'Codigo',
            'descripcion' => 'Ubicacion',
        ];
    }
}
