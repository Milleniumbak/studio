<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "simgqr".
 *
 * @property integer $pkimgqr
 * @property integer $fkevento
 * @property string $path
 * @property string $fechaing
 *
 * @property Seventosocial $fkevento0
 */
class Simgqr extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'simgqr';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fkevento'], 'integer'],
            [['fechaing'], 'safe'],
            [['path'], 'string', 'max' => 50],
            [['fkevento'], 'exist', 'skipOnError' => true, 'targetClass' => Seventosocial::className(), 'targetAttribute' => ['fkevento' => 'pkevento']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pkimgqr' => 'Pkimgqr',
            'fkevento' => 'Fkevento',
            'path' => 'Path',
            'fechaing' => 'Fechaing',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkevento0()
    {
        return $this->hasOne(Seventosocial::className(), ['pkevento' => 'fkevento']);
    }
}
