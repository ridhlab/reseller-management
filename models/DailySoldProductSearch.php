<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class DailySoldProductSearch extends Model
{
    public $product_id;
    public $seller_id;
    public $date;

    public function rules()
    {
        return [
            [['product_id', 'seller_id'], 'integer'],
            [['date'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = DailySoldProduct::find()->with(['product', 'product.seller']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSizeLimit' => [5, 100],
                'defaultPageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => ['date' => SORT_DESC],
                'attributes' => [
                    'id',
                    'date',
                    'stock',
                    'sold',
                    'product_id' => [
                        'asc' => ['products.name' => SORT_ASC],
                        'desc' => ['products.name' => SORT_DESC],
                    ],
                    'seller_id' => [
                        'asc' => ['sellers.name' => SORT_ASC],
                        'desc' => ['sellers.name' => SORT_DESC],
                    ],
                    'profit' => [
                        'asc' => ['(products.sell_price - products.original_price) * daily_sold_products.sold' => SORT_ASC],
                        'desc' => ['(products.sell_price - products.original_price) * daily_sold_products.sold' => SORT_DESC],
                    ],
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->joinWith(['product', 'product.seller']);
        $query->andFilterWhere(['daily_sold_products.product_id' => $this->product_id]);
        $query->andFilterWhere(['products.seller_id' => $this->seller_id]);
        $query->andFilterWhere(['daily_sold_products.date' => $this->date]);

        return $dataProvider;
    }
}
