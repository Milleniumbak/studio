<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "grepuesto".
 *
 * @property int $pkarticulo
 * @property string $descripcion
 * @property string $codigo_completo
 * @property int $fkgrupo
 * @property int $fksubgrupo
 * @property int $fkfabricante
 * @property int $fkmodelo
 * @property int $fksistema
 * @property string $nroparte
 * @property int $fkunidad
 * @property int $fkubicacion
 *
 * @property Gdetsolicitud[] $gdetsolicituds
 * @property Gfabricante $fkfabricante0
 * @property Ggrupo $fkgrupo0
 * @property Gmodelo $fkmodelo0
 * @property Gsistema $fksistema0
 * @property Gsubgrupo $fksubgrupo0
 * @property Gsaldo[] $gsaldos
 */
class Grepuesto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'grepuesto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fkgrupo', 'fksubgrupo', 'fkfabricante', 'fkmodelo', 'fksistema', 'fkunidad', 'fkubicacion'], 'required'],
            [['descripcion', 'codigo_completo', 'nroparte'], 'required'],

            [['fkgrupo', 'fksubgrupo', 'fkfabricante', 'fkmodelo', 'fksistema', 'fkunidad', 'fkubicacion'], 'default', 'value' => null],
            [['fkgrupo', 'fksubgrupo', 'fkfabricante', 'fkmodelo', 'fksistema', 'fkunidad', 'fkubicacion'], 'integer'],
            [['descripcion', 'codigo_completo'], 'string', 'max' => 50],
            [['nroparte'], 'string', 'max' => 15],
            [['fkfabricante'], 'exist', 'skipOnError' => true, 'targetClass' => Gfabricante::className(), 'targetAttribute' => ['fkfabricante' => 'pkfrabrica']],
            [['fkgrupo'], 'exist', 'skipOnError' => true, 'targetClass' => Ggrupo::className(), 'targetAttribute' => ['fkgrupo' => 'pkgrupo']],
            [['fkmodelo'], 'exist', 'skipOnError' => true, 'targetClass' => Gmodelo::className(), 'targetAttribute' => ['fkmodelo' => 'pkmodelo']],
            [['fksistema'], 'exist', 'skipOnError' => true, 'targetClass' => Gsistema::className(), 'targetAttribute' => ['fksistema' => 'pksistema']],
            [['fksubgrupo'], 'exist', 'skipOnError' => true, 'targetClass' => Gsubgrupo::className(), 'targetAttribute' => ['fksubgrupo' => 'pksubgrupo']],
            [['fkunidad'], 'exist', 'skipOnError' => true, 'targetClass' => Gunidad::className(), 'targetAttribute' => ['fkunidad' => 'pkunidad']],
            [['fkubicacion'], 'exist', 'skipOnError' => true, 'targetClass' => Gubicacion::className(), 'targetAttribute' => ['fkubicacion' => 'pkubicacion']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pkarticulo' => 'Pkarticulo',
            'descripcion' => 'Descripcion',
            'codigo_completo' => 'Codigo Completo',
            'fkgrupo' => 'Grupo',
            'fksubgrupo' => 'Sub-grupo',
            'fkfabricante' => 'Fabricante',
            'fkmodelo' => 'Modelo',
            'fksistema' => 'Sistema',
            'nroparte' => 'Nroparte',
            'fkunidad' => 'Unidad',
            'fkubicacion' => 'Ubicacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGdetsolicituds()
    {
        return $this->hasMany(Gdetsolicitud::className(), ['fkrepuesto' => 'pkarticulo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkfabricante0()
    {
        return $this->hasOne(Gfabricante::className(), ['pkfrabrica' => 'fkfabricante']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkgrupo0()
    {
        return $this->hasOne(Ggrupo::className(), ['pkgrupo' => 'fkgrupo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkmodelo0()
    {
        return $this->hasOne(Gmodelo::className(), ['pkmodelo' => 'fkmodelo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFksistema0()
    {
        return $this->hasOne(Gsistema::className(), ['pksistema' => 'fksistema']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFksubgrupo0()
    {
        return $this->hasOne(Gsubgrupo::className(), ['pksubgrupo' => 'fksubgrupo']);
    }

    public function getFkubicacion0()
    {
        return $this->hasOne(Gubicacion::className(), ['pkubicacion' => 'fkubicacion']);
    }

    public function getFkunidad0()
    {
        return $this->hasOne(Gunidad::className(), ['pkunidad' => 'fkunidad']);
    }
    /**

     * @return \yii\db\ActiveQuery
     */
    public function getGsaldos()
    {
        return $this->hasMany(Gsaldo::className(), ['fkrepuesto' => 'pkarticulo']);
    }
}
