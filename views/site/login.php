<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Masuk';
?>
<div class="site-login">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h3 class="card-title text-center mb-4"><?= Html::encode($this->title) ?></h3>
                    <p class="text-muted text-center mb-4">Silakan masukkan username dan password Anda</p>

                    <?php $form = ActiveForm::begin([
                        'id' => 'login-form',
                    ]); ?>

                    <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Username'])->label('Username') ?>

                    <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password'])->label('Password') ?>

                    <?= $form->field($model, 'rememberMe')->checkbox()->label('Ingat Saya') ?>

                    <div class="d-grid">
                        <?= Html::submitButton('Masuk', ['class' => 'btn btn-primary btn-lg', 'name' => 'login-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
