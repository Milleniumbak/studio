<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "simgusuario".
 *
 * @property integer $pkimgusuario
 * @property integer $fkusuario
 * @property string $path
 * @property string $fechaing
 *
 * @property Susuario $fkusuario0
 */
class Simgusuario extends \yii\db\ActiveRecord
{
    /**
     * Esta es la imagen donde se cargara
     * @var [image]
     */
    public $image;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'simgusuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image'], 'safe'], 
            [['image'], 'file', 'extensions' => 'jpg, png' ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pkimgusuario' => 'Pkimgusuario',
            'fkusuario' => 'Fkusuario',
            'path' => 'Nombre de Fotografia',
            'fechaing' => 'Fecha de Subida',
            'image' => 'Fotografia',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkusuario0()
    {
        return $this->hasOne(Susuario::className(), ['pkusuario' => 'fkusuario']);
    }
}
