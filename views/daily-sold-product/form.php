<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $isEdit ? 'Ubah Penjualan Harian' : 'Tambah Penjualan Harian';
?>

<div class="daily-sold-product-form">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_id')->dropDownList($products, ['prompt' => 'Pilih Produk'])->label('Produk') ?>

    <?= $form->field($model, 'date')->textInput(['type' => 'date'])->label('Tanggal') ?>

    <?= $form->field($model, 'stock')->textInput(['type' => 'number', 'min' => 0])->label('Stok') ?>

    <?php if ($isEdit): ?>
        <?= $form->field($model, 'sold')->textInput(['type' => 'number', 'min' => 0])->label('Terjual') ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton($isEdit ? 'Ubah' : 'Simpan', ['class' => $isEdit ? 'btn btn-primary' : 'btn btn-success']) ?>
        <?= Html::a('Batal', ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
