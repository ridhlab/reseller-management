<?php

/** @var yii\web\View $this */
/** @var app\models\DailySoldProduct[] $todayProducts */

use yii\helpers\Html;

$this->title = 'Beranda';
?>
<div class="site-index">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= Html::a('<i class="bi bi-plus-circle me-2"></i> Tambah Stok', ['/daily-sold-product/create'], ['class' => 'btn btn-success']) ?>
    </div>

    <h3>Produk Hari Ini (<?= date('d M Y') ?>)</h3>

    <?php if (empty($todayProducts)): ?>
        <div class="alert alert-info">
            Belum ada produk untuk hari ini. Klik "Tambah Stok" untuk menambah produk.
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($todayProducts as $item): ?>
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?= Html::encode($item->product ? $item->product->name : '-') ?></h5>
                            <p class="card-text text-muted mb-2">
                                <i class="bi bi-shop me-1"></i>
                                <?= Html::encode($item->product && $item->product->seller ? $item->product->seller->name : '-') ?>
                            </p>
                            <p class="card-text mb-1">
                                <i class="bi bi-calendar me-1"></i>
                                <?= Yii::$app->formatter->asDate($item->date) ?>
                            </p>
                            <p class="card-text mb-1">
                                <i class="bi bi-box me-1"></i>
                                Stok: <strong><?= $item->stock ?></strong>
                            </p>
                            <p class="card-text mb-1">
                                <i class="bi bi-cart-check me-1"></i>
                                Terjual: <strong><?= $item->sold ?></strong> / <?= $item->stock ?>
                            </p>

                            <?php
                            $totalIncomeSold = $item->product ? $item->product->sell_price * $item->sold : 0;
                            $totalIncomeSeller = $item->product ? $item->product->original_price * $item->sold : 0;
                            $profit = $totalIncomeSold - $totalIncomeSeller;
                            ?>
                            <hr class="my-2">
                            <p class="card-text mb-1 small">
                                <i class="bi bi-cash me-1"></i>
                                Pendapatan Jual: <strong><?= number_format($totalIncomeSold) ?></strong>
                            </p>
                            <p class="card-text mb-1 small">
                                <i class="bi bi-cash-stack me-1"></i>
                                Pendapatan Penjual: <strong><?= number_format($totalIncomeSeller) ?></strong>
                            </p>
                            <p class="card-text mb-3 small text-success">
                                <i class="bi bi-graph-up-arrow me-1"></i>
                                Keuntungan: <strong><?= number_format($profit) ?></strong>
                            </p>

                            <?php
                            $progress = $item->stock > 0 ? ($item->sold / $item->stock) * 100 : 0;
                            $progressClass = $progress >= 100 ? 'bg-success' : ($progress >= 50 ? 'bg-warning' : 'bg-primary');
                            ?>
                            <div class="progress mb-3" style="height: 10px;">
                                <div class="progress-bar <?= $progressClass ?>" role="progressbar" style="width: <?= $progress ?>%"></div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <?php if ($item->sold < $item->stock): ?>
                                <?= Html::a('<i class="bi bi-plus-lg me-1"></i> Jual +1', ['increment-sold', 'id' => $item->id], [
                                    'class' => 'btn btn-primary btn-sm w-100',
                                    'data' => [
                                        'confirm' => 'Apakah Anda yakin ingin menambah penjualan di produk ini?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                            <?php else: ?>
                                <button class="btn btn-secondary btn-sm w-100" disabled>
                                    <i class="bi bi-check-lg me-1"></i> Habis
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
