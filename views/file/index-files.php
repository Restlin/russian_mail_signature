<?php

use yii\bootstrap\Html;
use yii\grid\GridView;
use yii\web\View;
use app\models\FileSearch;
use yii\data\ActiveDataProvider;
use yii\bootstrap\Modal;
use restlin\pjaxindicator\PjaxIndicator as Pjax;
use kartik\export\ExportMenu;
use app\models\File;

/* @var $this View */
/* @var $searchModel FileSearch */
/* @var $dataProvider ActiveDataProvider */
/* @var $uploadForm string */
/* @var $fileService \app\services\FileService */

$this->title = 'Почта России';

?>

    <h1>Файлы</h1>

    <div class="row col-md-12">
        <p>
            <?= Html::a('Подписать файлы', ['file/sign-all', 'messageId' => $searchModel->messageId], ['class' => 'btn btn-primary']) ?>
        </p>
    </div>
    <?php Pjax::begin(['id' => 'grid-view-files']); ?>
    <br>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'name',
            [
                'attribute' => 'signCheck',
                'value' => fn(File $model) => $fileService->checkSign($model),
                'format' => 'raw',
            ],
            [
                'attribute' => 'sign',
                'format' => 'raw',
                'value' => fn(File $model) => $model->sign ? Html::a('скачать', ['/file/get', 'id' => $model->id, 'sign' => true], ['data-pjax' => 0]) : 'нет',
            ],
            [
                'label' => 'Файл',
                'format' => 'raw',
                'value' => fn(File $model) => Html::a('скачать', ['file/get', 'id' => $model->id], ['data-pjax' => 0]),
            ],
            [
                'label' => 'PDF',
                'format' => 'raw',
                'value' => fn(File $model) => file_exists($fileService->getFilePath($model).'.pdf') ? Html::a('скачать', ['file/get', 'id' => $model->id, 'pdf' => true], ['data-pjax' => 0]) : 'нет',
            ],
        ],
    ]);
    ?>

    <?php Pjax::end(); ?>

