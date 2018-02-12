<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gsistema".
 *
 * @property int $pksistema
 * @property string $codigo
 * @property string $descripcion
 *
 * @property Grepuesto[] $grepuestos
 */
class Gsistema extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gsistema';
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
            'pksistema' => 'Pksistema',
            'codigo' => 'Codigo',
            'descripcion' => 'Sistema',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrepuestos()
    {
        return $this->hasMany(Grepuesto::className(), ['fksistema' => 'pksistema']);
    }
}
