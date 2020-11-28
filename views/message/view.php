<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Message */

$this->title = 'Почта России';
\yii\web\YiiAsset::register($this);

?>
<div class="container">

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <p>

    <?php
    Modal::begin([
        'id' => 'modal-create-message',
        'header' => '<h3>Ответ</h3>',
        'toggleButton' => ['label' => 'Ответить', 'class' => 'btn btn-primary'],
        'size' => 'modal-lg',
    ]);

    echo $createReply;

    Modal::end();
    ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'message:ntext',
            'user_id',
            'status',
            'date_create',
        ],
    ]) ?>

    <?= $files ?>

</div>
