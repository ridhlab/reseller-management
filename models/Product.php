<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $name
 * @property int $sell_price
 * @property int $original_price
 * @property int $seller_id
 *
 * @property Seller $seller
 * @property DailySoldProduct[] $dailySoldProducts
 */
class Product extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%products}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'sell_price', 'original_price', 'seller_id'], 'required'],
            [['sell_price', 'original_price', 'seller_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['seller_id'], 'exist', 'skipOnError' => true, 'targetClass' => Seller::class, 'targetAttribute' => ['seller_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'sell_price' => 'Sell Price',
            'original_price' => 'Original Price',
            'seller_id' => 'Seller',
        ];
    }

    /**
     * Gets query for [[Seller]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSeller()
    {
        return $this->hasOne(Seller::class, ['id' => 'seller_id']);
    }

    /**
     * Gets query for [[DailySoldProducts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDailySoldProducts()
    {
        return $this->hasMany(DailySoldProduct::class, ['product_id' => 'id']);
    }
}
