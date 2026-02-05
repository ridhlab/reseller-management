<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $isEdit ? 'Update Daily Sold Product' : 'Create Daily Sold Product';
?>

<div class="daily-sold-product-form">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_id')->dropDownList($products, ['prompt' => 'Select Product']) ?>

    <?= $form->field($model, 'date')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'stock')->textInput(['type' => 'number', 'min' => 0]) ?>

    <?php if ($isEdit): ?>
        <?= $form->field($model, 'sold')->textInput(['type' => 'number', 'min' => 0]) ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton($isEdit ? 'Update' : 'Create', ['class' => $isEdit ? 'btn btn-primary' : 'btn btn-success']) ?>
        <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
