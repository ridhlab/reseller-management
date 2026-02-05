<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Penjual';
$this->registerJsFile('@web/js/grid-filter.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>

<div class="seller-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Tambah Penjual', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'label' => 'Nama',
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
