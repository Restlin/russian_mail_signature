<?php

use yii\web\View;
use kartik\file\FileInput;
use yii\web\JsExpression;
use yii\helpers\Url;
use app\models\File;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $file File */
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($file, 'ids')->widget(FileInput::class, [
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
        'allowedFileExtensions' => ['doc', 'docx', 'pdf', 'odt', 'txt'],
    ],
    'pluginEvents' => [
        'filebatchselected' => new JsExpression('function(event, files){$(this).fileinput("upload");}'),
    ],
]) ?>

<?php ActiveForm::end(); ?>
