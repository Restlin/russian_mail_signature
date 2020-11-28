<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Message */
/* @var $user \app\models\User */

$this->title = 'Почта России';
\yii\web\YiiAsset::register($this);

?>
<div class="container">

    <?php if ($user->isAdmin): ?>
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
    <?php endif; ?>

    <?php if (!$model->reply_to_message_id && !$model->reply): ?>
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
    <?php elseif (!$model->reply_to_message_id && $model->reply): ?>
    <p>
        <?= Html::a('Подписать ответ и отправить', ['view', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
    </p>

    <?php endif; ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'message:html',
            'status',
            'date_create:date',
        ],
    ]) ?>

    <?= $files ?>

</div>
