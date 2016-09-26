<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "susuario".
 *
 * @property integer $pkusuario
 * @property string $snombre
 * @property string $sapellido
 * @property string $semail
 * @property string $stelefono
 * @property string $spassword
 * @property integer $stipousuario
 * @property string $sestado
 *
 * @property Senvio[] $senvios
 * @property Simgusuario[] $simgusuarios
 * @property Sscanner[] $sscanners
 */
class Susuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'susuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['stipousuario'], 'integer'],
            [['snombre', 'sapellido', 'spassword'], 'string', 'max' => 50],
            [['semail'], 'string', 'max' => 25],
            [['stelefono'], 'string', 'max' => 15],
            [['sestado'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pkusuario' => 'Pkusuario',
            'snombre' => 'Snombre',
            'sapellido' => 'Sapellido',
            'semail' => 'Semail',
            'stelefono' => 'Stelefono',
            'spassword' => 'Spassword',
            'stipousuario' => 'Stipousuario',
            'sestado' => 'Sestado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSenvios()
    {
        return $this->hasMany(Senvio::className(), ['fkusuario' => 'pkusuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSimgusuarios()
    {
        return $this->hasMany(Simgusuario::className(), ['fkusuario' => 'pkusuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSscanners()
    {
        return $this->hasMany(Sscanner::className(), ['fkusuario' => 'pkusuario']);
    }
}
