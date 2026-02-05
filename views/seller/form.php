<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $isEdit ? 'Update Seller: ' . $model->name : 'Create Seller';
?>

<div class="seller-form">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($isEdit ? 'Update' : 'Create', ['class' => $isEdit ? 'btn btn-primary' : 'btn btn-success']) ?>
        <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
