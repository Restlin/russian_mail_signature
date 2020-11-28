<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\web\JsExpression;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model app\models\Message */
/* @var $file \app\models\File */

$this->title = 'Почта России';
?>
<div class="message-create">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'files[]')->widget(FileInput::class, [
        'name' => 'files',
        'options' => [
            'id' => 'files-upload',
            'multiple' => true,
        ],
        'pluginOptions' => [
            'uploadAsync' => false,
            'encodeUrl' => false,
            'uploadUrl' => Url::toRoute(['/file/upload']),
            'preferIconicPreview' => true,
            'maxFilePreviewSize' => 0,
            'showUpload' => false,
            'disabledPreviewExtensions' => null,
            'hideThumbnailContent' => true,
            /*'fileActionSettings' => [
                'showZoom' => false,
                'showDrag' => false,
                'downloadClass' => 'btn btn-sm btn-kv btn-default btn-outline-secondary',
                'removeClass' => 'btn btn-sm btn-kv btn-default btn-outline-secondary',
            ],*/
            'initialPreviewAsData' => true,
            'initialPreviewFileType' => 'image',
            'overwriteInitial' => false,
            'layoutTemplates' => [
                'actionDownload' => '<a class="{downloadClass}" title="{downloadTitle}" href="{downloadUrl}" target="_blank" data-pjax="0">{downloadIcon}</a>',
            ],
            'allowedFileExtensions' => ['doc', 'docx', 'pdf', 'odt'],
        ],
        'pluginEvents' => [
            'filebatchselected' => new JsExpression('function(event, files){$(this).fileinput("upload");}'),
        ],
    ]) ?>


    <div class="form-group" style="padding-top: 20px;">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
