<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\web\JsExpression;
use yii\helpers\Url;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Message */

$this->title = 'Почта России';
?>
<div class="container">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'message')->widget(CKEditor::class, [
        'preset' => 'basic',
    ]) ?>

    <div class="form-group" style="padding-top: 20px;">
        <?= Html::a('Назад', ['view', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
