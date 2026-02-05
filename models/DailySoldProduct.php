<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "daily_sold_products".
 *
 * @property int $id
 * @property int $product_id
 * @property string $date
 * @property int $stock
 * @property int $sold
 *
 * @property Product $product
 */
class DailySoldProduct extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%daily_sold_products}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'date', 'stock'], 'required'],
            [['sold'], 'required', 'on' => 'update'],
            [['product_id', 'stock', 'sold'], 'integer'],
            [['sold'], 'default', 'value' => 0],
            [['sold'], 'compare', 'compareAttribute' => 'stock', 'operator' => '<=', 'message' => 'Sold cannot be more than Stock'],
            [['date'], 'date', 'format' => 'php:Y-m-d'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
            [['product_id'], 'validateUniqueProductDate', 'on' => 'default'],
        ];
    }

    /**
     * Validates that product_id + date combination is unique (only for new records)
     */
    public function validateUniqueProductDate($attribute, $params)
    {
        if (!$this->isNewRecord) {
            return;
        }

        $exists = self::find()
            ->where(['product_id' => $this->product_id, 'date' => $this->date])
            ->exists();

        if ($exists) {
            $this->addError($attribute, 'This product has already been added for this date.');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product',
            'date' => 'Date',
            'stock' => 'Stock',
            'sold' => 'Sold',
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    /**
     * Gets seller through product relation.
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSeller()
    {
        return $this->hasOne(Seller::class, ['id' => 'seller_id'])->via('product');
    }
}
