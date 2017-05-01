<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stipoevento".
 *
 * @property integer $pktipoevento
 * @property string $codigo
 * @property string $descripcion
 */
class Stipoevento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stipoevento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo'], 'string', 'max' => 3],
            [['descripcion'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pktipoevento' => 'Pktipoevento',
            'codigo' => 'Codigo',
            'descripcion' => 'Descripcion',
        ];
    }
}
