<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
/**
 * This is the model class for table "simgusuario".
 *
 * @property integer $pkimgusuario
 * @property integer $fkusuario
 * @property string $path
 * @property string $fechaing
 * @property string $idimagecloud

 * @property Susuario $fkusuario0
 */

class Simgusuario extends \yii\db\ActiveRecord
{
    // upload_max_filesize verificar esta propiedad en php.ini si no guarda la imagen
    /**
     * Esta es la imagen donde se cargara
     * @var [image]
     */
    public $image;


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
            [['image'], 'safe'], 
            [['image'], 'file', 'extensions' => 'jpg, png' ],
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
            'path' => 'Nombre de Fotografia',
            'fechaing' => 'Fecha de Subida',
            'image' => 'Fotografia',
            'idimagecloud' => 'Identificador de imagen en google',
        ];
    }
    /**
     * Sube la fotografia al servidor
     * @return [type] [description]
     */
    public function uploadImage(){
        //obtenemos la imagen que nos llega
        $image = UploadedFile::getInstance($this, 'image');
    
        if (empty($image)) {
            Yii::warning("imagen falsse");
            return false;
        }

        // obtenemos la extension
        $ext = end((explode(".", $image->name)));
        $ext = strtolower($ext);
        // generamos un nombre aleatorio de 20 caracteres
        $this->path = Yii::$app->security->generateRandomString(20).".{$ext}";

        return $image;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkusuario0()
    {
        return $this->hasOne(Susuario::className(), ['pkusuario' => 'fkusuario']);
    }
}
