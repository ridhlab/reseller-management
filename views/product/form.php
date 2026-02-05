<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $isEdit ? 'Ubah Produk: ' . $model->name : 'Tambah Produk';
?>

<div class="product-form">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Nama') ?>

    <?= $form->field($model, 'sell_price')->textInput(['type' => 'number'])->label('Harga Jual') ?>

    <?= $form->field($model, 'original_price')->textInput(['type' => 'number'])->label('Harga Asli') ?>

    <?= $form->field($model, 'seller_id')->dropDownList($sellers, ['prompt' => 'Pilih Penjual'])->label('Penjual') ?>

    <div class="form-group">
        <?= Html::submitButton($isEdit ? 'Ubah' : 'Simpan', ['class' => $isEdit ? 'btn btn-primary' : 'btn btn-success']) ?>
        <?= Html::a('Batal', ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
