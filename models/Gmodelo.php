<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gmodelo".
 *
 * @property int $pkmodelo
 * @property string $codigo
 * @property string $descripcion
 *
 * @property Grepuesto[] $grepuestos
 */
class Gmodelo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gmodelo';
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
            'pkmodelo' => 'Pkmodelo',
            'codigo' => 'Codigo',
            'descripcion' => 'Modelo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrepuestos()
    {
        return $this->hasMany(Grepuesto::className(), ['fkmodelo' => 'pkmodelo']);
    }
}
