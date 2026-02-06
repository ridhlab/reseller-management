<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);

$isGuest = Yii::$app->user->isGuest;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header id="header">
        <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top'],
            'togglerContent' => '<i class="bi bi-list"></i>',
            'togglerOptions' => ['id' => 'sidebar-toggle', 'style' => $isGuest ? 'display:none' : ''],
        ]);

        if (!$isGuest) {
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav ms-auto'],
                'items' => [
                    [
                        'label' => '<i class="bi bi-box-arrow-right me-1"></i> Keluar',
                        'url' => ['/site/logout'],
                        'encode' => false,
                        'linkOptions' => [
                            'data-method' => 'post',
                            'class' => 'nav-link',
                        ],
                    ],
                ],
            ]);
        }

        NavBar::end();
        ?>
    </header>

    <main id="main" class="flex-shrink-0" role="main">
        <?php if ($isGuest): ?>
            <!-- Full width for login page -->
            <div class="container py-5" style="margin-top: 56px;">
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        <?php else: ?>
            <!-- With sidebar for logged in users -->
            <div class="container-fluid">
                <div class="row">
                    <!-- Sidebar -->
                    <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar py-3">
                        <div class="position-sticky pt-3">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <?= Html::a('<i class="bi bi-house-door me-2"></i> Beranda', ['/site/index'], [
                                        'class' => 'nav-link' . (Yii::$app->controller->id === 'site' && Yii::$app->controller->action->id === 'index' ? ' active' : '')
                                    ]) ?>
                                </li>
                                <li class="nav-item">
                                    <?= Html::a('<i class="bi bi-people me-2"></i> Penjual', ['/seller/index'], [
                                        'class' => 'nav-link' . (Yii::$app->controller->id === 'seller' ? ' active' : '')
                                    ]) ?>
                                </li>
                                <li class="nav-item">
                                    <?= Html::a('<i class="bi bi-box me-2"></i> Produk', ['/product/index'], [
                                        'class' => 'nav-link' . (Yii::$app->controller->id === 'product' ? ' active' : '')
                                    ]) ?>
                                </li>
                                <li class="nav-item">
                                    <?= Html::a('<i class="bi bi-calendar-check me-2"></i> Penjualan Harian', ['/daily-sold-product/index'], [
                                        'class' => 'nav-link' . (Yii::$app->controller->id === 'daily-sold-product' ? ' active' : '')
                                    ]) ?>
                                </li>
                            </ul>
                        </div>
                    </nav>

                    <!-- Main content -->
                    <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-3">
                        <?php if (!empty($this->params['breadcrumbs'])): ?>
                            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
                        <?php endif ?>
                        <?= Alert::widget() ?>
                        <?= $content ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </main>

    <footer id="footer" class="mt-auto py-3 bg-light">
        <div class="container">
            <div class="row text-muted">
                <div class="col-md-6 text-center text-md-start">&copy; My Company <?= date('Y') ?></div>
                <div class="col-md-6 text-center text-md-end"><?= Yii::powered() ?></div>
            </div>
        </div>
    </footer>

    <?php if (!$isGuest): ?>
    <script>
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
        });
    </script>
    <?php endif; ?>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
