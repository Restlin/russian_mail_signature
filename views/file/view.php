<?php

use yii\web\View;
use app\models\File;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\web\YiiAsset;

/* @var $this View */
/* @var $model File */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Файлы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

YiiAsset::register($this);
?>
<div class="container">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?=
        Html::a('Подписать', ['sign', 'id' => $model->id], [
            'class' => 'btn btn-success',
            'data' => [
                'confirm' => "Вы действительно хотите подписать файл {$model->name}?",
                'method' => 'post',
            ],
        ])
        ?>
        <?=
        Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить данные?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>
    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'mime',
            [
                'attribute' => 'size',
                'value' => Yii::$app->formatter->asShortSize($model->size),
            ],
            /* [
              'attribute' => 'status',
              'value' => $model->getStatusName(),
              'format' => 'html',
              ], */
            [
                'attribute' => 'signCheck',
                'value' => fn(File $model) => $fileService->checkSign($model),
                'format' => 'raw',
            ],
            [
                'attribute' => 'sign',
                'format' => 'raw',
                'value' => fn(File $model) => Html::a('скачать', ['/file/get', 'id' => $model->id, 'sign' => true]),
            ]
        ],
    ])
    ?>
</div>
