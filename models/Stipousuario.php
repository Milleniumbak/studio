<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stipousuario".
 *
 * @property integer $pktipousuario
 * @property string $codigo
 * @property string $descripcion
 */
class Stipousuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stipousuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'descripcion'], 'required'],
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
            'pktipousuario' => 'Pktipousuario',
            'codigo' => 'Codigo',
            'descripcion' => 'Descripcion',
        ];
    }
}
