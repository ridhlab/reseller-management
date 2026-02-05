<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Penjualan Harian';
$this->registerJsFile('@web/js/grid-filter.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>

<div class="daily-sold-product-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Tambah Penjualan Harian', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'product_id',
                'label' => 'Produk',
                'value' => function ($model) {
                    return $model->product ? $model->product->name : '-';
                },
            ],
            [
                'attribute' => 'seller_id',
                'label' => 'Penjual',
                'value' => function ($model) {
                    return $model->product && $model->product->seller ? $model->product->seller->name : '-';
                },
                'filter' => Html::activeDropDownList($searchModel, 'seller_id', $sellers, [
                    'class' => 'form-control',
                    'prompt' => 'Semua Penjual',
                ]),
            ],
            [
                'attribute' => 'date',
                'label' => 'Tanggal',
                'format' => 'date',
                'filter' => Html::activeInput('date', $searchModel, 'date', [
                    'class' => 'form-control',
                ]),
            ],
            [
                'attribute' => 'stock',
                'label' => 'Stok',
            ],
            [
                'attribute' => 'sold',
                'label' => 'Terjual',
            ],
            [
                'label' => 'Harga Asli',
                'value' => function ($model) {
                    return $model->product ? number_format($model->product->original_price) : '-';
                },
            ],
            [
                'label' => 'Harga Jual',
                'value' => function ($model) {
                    return $model->product ? number_format($model->product->sell_price) : '-';
                },
            ],
            [
                'label' => 'Total Pendapatan Jual',
                'value' => function ($model) {
                    if ($model->product) {
                        return number_format($model->product->sell_price * $model->sold);
                    }
                    return '-';
                },
            ],
            [
                'label' => 'Total Pendapatan Penjual',
                'value' => function ($model) {
                    if ($model->product) {
                        return number_format($model->product->original_price * $model->sold);
                    }
                    return '-';
                },
            ],
            [
                'attribute' => 'profit',
                'label' => 'Keuntungan',
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
                            'title' => 'Ubah',
                            'class' => 'btn btn-primary btn-sm',
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<i class="bi bi-trash"></i>', $url, [
                            'title' => 'Hapus',
                            'class' => 'btn btn-danger btn-sm',
                            'data' => [
                                'confirm' => 'Apakah Anda yakin ingin menghapus item ini?',
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
        <label>Per halaman:</label>
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
