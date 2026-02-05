<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $isEdit ? 'Update Product: ' . $model->name : 'Create Product';
?>

<div class="product-form">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sell_price')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'original_price')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'seller_id')->dropDownList($sellers, ['prompt' => 'Select Seller']) ?>

    <div class="form-group">
        <?= Html::submitButton($isEdit ? 'Update' : 'Create', ['class' => $isEdit ? 'btn btn-primary' : 'btn btn-success']) ?>
        <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
