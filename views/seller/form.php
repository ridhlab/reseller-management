<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $isEdit ? 'Ubah Penjual: ' . $model->name : 'Tambah Penjual';
?>

<div class="seller-form">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Nama') ?>

    <div class="form-group">
        <?= Html::submitButton($isEdit ? 'Ubah' : 'Simpan', ['class' => $isEdit ? 'btn btn-primary' : 'btn btn-success']) ?>
        <?= Html::a('Batal', ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
