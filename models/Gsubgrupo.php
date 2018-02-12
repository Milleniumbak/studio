<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gsubgrupo".
 *
 * @property int $pksubgrupo
 * @property string $codigo
 * @property string $descripcion
 *
 * @property Grepuesto[] $grepuestos
 */
class Gsubgrupo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gsubgrupo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo'], 'string', 'max' => 2],
            [['descripcion'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pksubgrupo' => 'Pksubgrupo',
            'codigo' => 'Codigo',
            'descripcion' => 'Sub-Grupo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrepuestos()
    {
        return $this->hasMany(Grepuesto::className(), ['fksubgrupo' => 'pksubgrupo']);
    }
}
