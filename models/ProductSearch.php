<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class ProductSearch extends Model
{
    public $name;
    public $seller_id;

    public function rules()
    {
        return [
            [['name'], 'safe'],
            [['seller_id'], 'integer'],
        ];
    }

    public function search($params)
    {
        $query = Product::find()->with('seller');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSizeLimit' => [5, 100],
                'defaultPageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => ['id' => SORT_ASC],
                'attributes' => [
                    'id',
                    'name',
                    'sell_price',
                    'original_price',
                    'seller_id' => [
                        'asc' => ['sellers.name' => SORT_ASC],
                        'desc' => ['sellers.name' => SORT_DESC],
                    ],
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->joinWith('seller');
        $query->andFilterWhere(['like', 'products.name', $this->name]);
        $query->andFilterWhere(['products.seller_id' => $this->seller_id]);

        return $dataProvider;
    }
}
