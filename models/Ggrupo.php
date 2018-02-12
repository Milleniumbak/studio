<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ggrupo".
 *
 * @property int $pkgrupo
 * @property string $codigo
 * @property string $descripcion
 *
 * @property Grepuesto[] $grepuestos
 */
class Ggrupo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ggrupo';
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
            'pkgrupo' => 'Pkgrupo',
            'codigo' => 'Codigo',
            'descripcion' => 'Grupo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrepuestos()
    {
        return $this->hasMany(Grepuesto::className(), ['fkgrupo' => 'pkgrupo']);
    }
}
