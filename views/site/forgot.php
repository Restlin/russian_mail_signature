<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Почта России';
?>
<div class="container">
    <div class="col-md-12 text-center signin-title">
        <span class="">Восстановление пароля</span>
    </div>

    <?php $form = ActiveForm::begin([
        'id' => 'forgot-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            //'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            //'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'class' => 'form-control square', 'placeholder' => 'Эл. почта'])->label(false); ?>

    <div class="col-md-12 text-center">
        <?= Html::submitButton('Восстановить', ['class' => 'btn btn-primary', 'name' => 'login-button']); ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
