<?php
/* @var $this View */
/* @var $form ActiveForm */
/* @var $model RegistrationForm */

use app\security\RegistrationForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

$this->title = 'Подтверждение email';
?>
<div class="container">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>На указанный Вами email адрес было выслано письмо с кодом подтверждения. Пожалуйста, введите его:</p>
    <?php $form = ActiveForm::begin(['id' => 'confirm-form']); ?>
    <?= $form->field($model, 'code')->textInput(['autofocus' => true, 'class' => '']); ?>
    <div class="form-group">
        <?= Html::submitButton('Подтвердить', ['class' => 'btn btn-primary', 'name' => 'confirm-button']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
