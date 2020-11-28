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
<div class="message-create">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'message')->widget(CKEditor::class, [
        'preset' => 'basic',
    ]) ?>

    <?= $form->field($model, 'upload_files[]')->widget(FileInput::class, [
        'options' => [
            'id' => 'message_upload_files',
            'multiple' => true,
        ],
        'pluginOptions' => [
            'preferIconicPreview' => true,
            'maxFilePreviewSize' => 0,
            'showUpload' => false,
            'showRemove' => true,
            'browseOnZoneClick' => true,
            'disabledPreviewExtensions' => null,
            'fileActionSettings' => [
                'showZoom' => false,
            ],
            'maxFileSize' => 5120,
            'allowedFileExtensions' => ['doc', 'docx', 'pdf', 'odt'],
        ],
    ]) ?>


    <div class="form-group" style="padding-top: 20px;">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
