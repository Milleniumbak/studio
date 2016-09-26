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
            [['fkusuario'], 'required'],
            [['fkusuario'], 'integer'],
            [['fechaing'], 'safe'],
            [['path'], 'string', 'max' => 50],
            [['fkusuario'], 'exist', 'skipOnError' => true, 'targetClass' => Susuario::className(), 'targetAttribute' => ['fkusuario' => 'pkusuario']],
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
            'path' => 'Path',
            'fechaing' => 'Fechaing',
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
