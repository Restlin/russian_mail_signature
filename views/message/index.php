<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $createForm string */

$this->title = 'Почта России';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-index">

    <div class="col-md-12" style="padding-bottom: 20px">


    <?php
    Modal::begin([
        'id' => 'modal-create-message',
        'header' => '<h3>Обращение</h3>',
        'toggleButton' => ['label' => 'Написать обращение', 'class' => 'btn btn-primary'],
        'size' => 'modal-lg',
    ]);

    echo $createForm;

    Modal::end();
    ?>
    </div>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'message:ntext',
            'status',

            [
                'class' => 'yii\grid\ActionColumn',
                'controller' => 'message',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
