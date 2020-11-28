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

$this->title = 'Почта России';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="container">

    <?php Pjax::begin(['id' => 'grid-view-files']); ?>
    <br>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute' => 'name',
                'value' => function (File $model) {
                    return Html::a($model->name, ['view', 'id' => $model->id]);
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'status',
                'filter' => File::getStatuses(),
                'value' => function (File $model) {
                    return $model->getStatusName();
                },
                'format' => 'html',
            ],
            [
                'class' => yii\grid\ActionColumn::class,
                'template' => '{delete}'
            ],
        ],
    ]);
    ?>

    <?php Pjax::end(); ?>

</div>
