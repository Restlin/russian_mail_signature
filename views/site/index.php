<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user \app\models\User */
/* @var $messages string */

$this->title = 'Почта России';
?>
<div class="container">
    <span class="help-block">Добрый день, <?= $user->name ?>!</span>
    <?= $messages ?>
</div>
