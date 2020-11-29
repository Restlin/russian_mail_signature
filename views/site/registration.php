<?php

use app\security\RegistrationForm;
use borales\extensions\phoneInput\PhoneInput;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $form ActiveForm */
/* @var $model RegistrationForm */


$this->title = 'Почта России';
?>

<div class="container">

    <div class="col-md-12 text-center signin-title">
        <span class="">Регистрация</span>
    </div>

    <?php $form = ActiveForm::begin([
        'id' => 'registration-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            //'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            //'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'surname')->textInput()->label($model->getAttributeLabel('surname') . ' *') ?>
    <?= $form->field($model, 'name')->textInput()->label($model->getAttributeLabel('name') . ' *') ?>
    <?= $form->field($model, 'patronymic')->textInput() ?>
    <?= $form->field($model, 'email')->textInput()->label('Email *') ?>

    <?=
        $form->field($model, 'phone')->widget(PhoneInput::class, [
            'jsOptions' => [
                'preferredCountries' => ['ru', 'kz', 'by', 'md', 'az', 'tm', 'tj', 'ua']
            ],
            'options' => [
                'placeholder' => ' ',
                'class' => 'form-control',
                'autocomplete' => 'new-password'
            ]
        ])
    ?>

    <?= $form->field($model, 'password')->passwordInput()->label($model->getAttributeLabel('password') . ' *') ?>
    <?= $form->field($model, 'password_confirm')->passwordInput()->label($model->getAttributeLabel('password_confirm') . ' *') ?>

    <div class="col-md-12 hint-block text-center">
        Поля, отмеченные звездочкой (*), обязательны для заполнения.
    </div>

    <div class="col-md-12 text-center" style="padding-top: 20px;">
        <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <div class="col-md-12 text-center" style="padding-top: 10px;">
                Уже зарегистрированы?
            <?= Html::a('Войти', ['/site/login']) ?>
    </div>
</div>
