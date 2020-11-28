<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use app\models\Message;

/* @var $this yii\web\View */
/* @var $model app\models\Message */
/* @var $user \app\models\User */

$this->title = 'Почта России';
\yii\web\YiiAsset::register($this);

?>
<div class="container">
    
    <p>
        <?= Html::a('PDF', ['pdf', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить обращение?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php if ($model->question): ?>
    <p>
        <?= Html::a('Посмотреть вопрос', ['view', 'id' => $model->question->id], ['class' => 'btn btn-primary']) ?>
    </p>
    <?php endif; ?>

    <?php if ($user->isAdmin && !$model->reply_to_message_id && !$model->reply): ?>
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
        <?= Html::a('Посмотреть ответ', ['view', 'id' => $model->reply->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?php elseif ($user->isAdmin && $model->status == Message::STATUS_IS_DONE && $model->reply_to_message_id): ?>

    <p>
        <?= Html::a(
            'Согласовать и отправить', 
            ['send', 'id' => $model->id], 
            [
                'class' => 'btn btn-warning',
                'data' => [
                    'confirm' => 'Вы действительно хотите подписать данное обращение и все приложенные файлы?',
                ],
            ]
        ) ?>
    </p>

    <?php endif; ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'message:html',
            'statusName:html',
            'date_create:date',
        ],
    ]) ?>

    <?= $files ?>

</div>
