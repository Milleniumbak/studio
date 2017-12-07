<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "simgevent".
 *
 * @property integer $pkimgevent
 * @property integer $fkevent
 * @property string $path
 * @property string $fechaing
 * @property string $estado
 * @property string $idimagecloud
 *
 * @property Seventosocial $fkevent0
 * @property Sscanner[] $sscanners
 */
class Simgevent extends \yii\db\ActiveRecord
{    
    /**
     * Esta es la fotografia que se cargara
     * @var [type]
     */
    public $image;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'simgevent';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image'], 'safe'],
            [['image'], 'file', 'extensions' => 'jpg, png', 'maxFiles' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pkimgevent' => 'Pkimgevent',
            'fkevent' => 'Fkevent',
            'path' => 'Nombre de fotografia',
            'fechaing' => 'Fecha de subida',
            'image' => 'Fotografia',
            "estado" => "Estado de fotografia",
            "idimagecloud" => "Id Cloud image"
        ];
    }

    /**
     * Sube la fotografia al servidor
     * @return [type] [description]
     */
    public function uploadImage(){
        //obtenemos la imagen que nos llega
        $image = UploadedFile::getInstances($this, 'image');

        if (empty($image)) {
            Yii::warning("imagen falsse");
            return false;
        }else{
            Yii::warning("Nro de imagenes : " . count($image));
        }

        return $image;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkevent0()
    {
        return $this->hasOne(Seventosocial::className(), ['pkevento' => 'fkevent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSscanners()
    {
        return $this->hasMany(Sscanner::className(), ['fkimgevent' => 'pkimgevent']);
    }


}
