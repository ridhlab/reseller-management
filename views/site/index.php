<?php

/** @var yii\web\View $this */
/** @var app\models\DailySoldProduct[] $todayProducts */

use yii\helpers\Html;

$this->title = 'Dashboard';
?>
<div class="site-index">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= Html::a('<i class="bi bi-plus-circle me-2"></i> Add Stock', ['/daily-sold-product/create'], ['class' => 'btn btn-success']) ?>
    </div>

    <h3>Today's Products (<?= date('d M Y') ?>)</h3>

    <?php if (empty($todayProducts)): ?>
        <div class="alert alert-info">
            No products added for today. Click "Add Stock" to add products.
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
                                Stock: <strong><?= $item->stock ?></strong>
                            </p>
                            <p class="card-text mb-3">
                                <i class="bi bi-cart-check me-1"></i>
                                Sold: <strong><?= $item->sold ?></strong> / <?= $item->stock ?>
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
                                <?= Html::a('<i class="bi bi-plus-lg me-1"></i> Sell +1', ['increment-sold', 'id' => $item->id], [
                                    'class' => 'btn btn-primary btn-sm w-100',
                                    'data' => ['method' => 'post'],
                                ]) ?>
                            <?php else: ?>
                                <button class="btn btn-secondary btn-sm w-100" disabled>
                                    <i class="bi bi-check-lg me-1"></i> Sold Out
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
