<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gfabricante".
 *
 * @property int $pkfrabrica
 * @property string $codigo
 * @property string $descripcion
 *
 * @property Grepuesto[] $grepuestos
 */
class Gfabricante extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gfabricante';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo'], 'string', 'max' => 3],
            [['descripcion'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pkfrabrica' => 'Pkfrabrica',
            'codigo' => 'Codigo',
            'descripcion' => 'Fabricante',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrepuestos()
    {
        return $this->hasMany(Grepuesto::className(), ['fkfabricante' => 'pkfrabrica']);
    }
}
