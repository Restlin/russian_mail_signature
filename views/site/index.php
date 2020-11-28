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

<nav class="navbar navbar-body navbar-static-top">
    <div class="container">
        <ul class="nav navbar-nav">
            <li><a href="#">Письма</a></li>
            <li><a href="#">Отправить посылку</a></li>
            <li><a href="#">Вызвать курьера</a></li>
            <li><a href="#">Платежи и переводы</a></li>
            <!--<li><a href="#">Отделения</a></li>!-->
            <li><?= Html::a('Обращение с подписью', ['site/pdf'])?></li>
        </ul>
    </div>
</nav>
