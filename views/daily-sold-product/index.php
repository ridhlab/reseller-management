<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Daily Sold Products';
$this->registerJsFile('@web/js/grid-filter.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>

<div class="daily-sold-product-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Daily Sold Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'product_id',
                'label' => 'Product',
                'value' => function ($model) {
                    return $model->product ? $model->product->name : '-';
                },
            ],
            [
                'attribute' => 'seller_id',
                'label' => 'Seller',
                'value' => function ($model) {
                    return $model->product && $model->product->seller ? $model->product->seller->name : '-';
                },
                'filter' => Html::activeDropDownList($searchModel, 'seller_id', $sellers, [
                    'class' => 'form-control',
                    'prompt' => 'All Seller',
                ]),
            ],
            [
                'attribute' => 'date',
                'label' => 'Date',
                'format' => 'date',
                'filter' => Html::activeInput('date', $searchModel, 'date', [
                    'class' => 'form-control',
                ]),
            ],
            [
                'attribute' => 'stock',
                'label' => 'Stock',
            ],
            [
                'attribute' => 'sold',
                'label' => 'Sold',
            ],
            [
                'label' => 'Original Price',
                'value' => function ($model) {
                    return $model->product ? number_format($model->product->original_price) : '-';
                },
            ],
            [
                'label' => 'Sell Price',
                'value' => function ($model) {
                    return $model->product ? number_format($model->product->sell_price) : '-';
                },
            ],
            [
                'label' => 'Total Income Sold',
                'value' => function ($model) {
                    if ($model->product) {
                        return number_format($model->product->sell_price * $model->sold);
                    }
                    return '-';
                },
            ],
            [
                'label' => 'Total Income Seller',
                'value' => function ($model) {
                    if ($model->product) {
                        return number_format($model->product->original_price * $model->sold);
                    }
                    return '-';
                },
            ],
            [
                'attribute' => 'profit',
                'label' => 'Profit',
                'value' => function ($model) {
                    if ($model->product) {
                        $totalIncomeSold = $model->product->sell_price * $model->sold;
                        $totalIncomeSeller = $model->product->original_price * $model->sold;
                        return number_format($totalIncomeSold - $totalIncomeSeller);
                    }
                    return '-';
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<i class="bi bi-pencil"></i>', $url, [
                            'title' => 'Update',
                            'class' => 'btn btn-primary btn-sm',
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<i class="bi bi-trash"></i>', $url, [
                            'title' => 'Delete',
                            'class' => 'btn btn-danger btn-sm',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                ],
            ],
        ],
        'pager' => [
            'class' => 'yii\widgets\LinkPager',
        ],
        'layout' => "{summary}\n{items}\n<div class='text-center'>{pager}</div>",
    ]); ?>

    <div class="form-group">
        <label>Per page:</label>
        <?= Html::dropDownList(
            'per-page',
            Yii::$app->request->get('per-page', 10),
            [5 => '5', 10 => '10', 20 => '20', 50 => '50', 100 => '100'],
            [
                'class' => 'form-control',
                'style' => 'width: 100px; display: inline-block;',
                'onchange' => "var params = new URLSearchParams(window.location.search); params.set('per-page', this.value); params.delete('page'); window.location.href = window.location.pathname + '?' + params.toString();",
            ]
        ) ?>
    </div>
</div>
