<?php

namespace app\models;

use Yii;
use yii2mod\cart\models\CartItemInterface;
/**
 * This is the model class for table "scompraimpresa".
 *
 * @property integer $pkcompraimpresa
 * @property integer $item
 * @property integer $fkimgevent
 * @property integer $cantidad
 * @property string $precio
 * @property integer $fktipopapel
 * @property integer $fkdimension
 * @property integer $fkcompra
 * @property integer $tipocompra
 *
 * @property Sdimension $fkdimension0
 * @property Simgevent $fkimgevent0
 * @property Stipopapel $fktipopapel0
 */
class Scompraimpresa extends \yii\db\ActiveRecord implements CartItemInterface
{
    public $destipocompra;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scompraimpresa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item', 'fkimgevent', 'cantidad', 'fktipopapel', 'fkdimension', 'tipocompra'], 'integer'],
            [['fkimgevent'], 'required'],
            [['precio'], 'number'],
            [['fkimgevent'], 'exist', 'skipOnError' => true, 'targetClass' => Simgevent::className(), 'targetAttribute' => ['fkimgevent' => 'pkimgevent']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pkcompraimpresa' => 'Pkcompraimpresa',
            'item' => 'Item',
            'fkimgevent' => 'Fotografia a comprar',
            'cantidad' => 'Cantidad',
            'precio' => 'Precio',
            'fktipopapel' => 'Tipo de papel',
            'fkdimension' => 'Dimension del papel',
            'fkcompra' => 'Fkcompra',
            'tipocompra' => 'Tipo de compra',
            'destipocompra' => 'Tipo de compra'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkdimension0()
    {
        return $this->hasOne(Sdimension::className(), ['pkdimension' => 'fkdimension']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkimgevent0()
    {
        return $this->hasOne(Simgevent::className(), ['pkimgevent' => 'fkimgevent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFktipopapel0()
    {
        return $this->hasOne(Stipopapel::className(), ['pktipopapel' => 'fktipopapel']);
    }

    // metodos que se implementará para el carrito de compras
    public function getPrice()
    {   // el precio sera 4 bs por defecto
        return $this->precio;
    }

    public function getLabel()
    {
        return "tusfotos";
    }

    public function getUniqueId()
    {
        return $this->fkimgevent;
    }

}
