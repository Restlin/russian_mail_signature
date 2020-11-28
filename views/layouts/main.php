<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => Yii::$app->name,
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-head navbar-fixed-top',
                ],
            ]);
            if (Yii::$app->user->isGuest) {
                $menuItems = [
                    ['label' => 'Войти', 'url' => ['/site/login']]
                ];
            } else {
                $user = Yii::$app->user->getIdentity()->getUser();
                $menuItems = [
                    [
                        'label' => $user->name . ' ' . $user->patronymic . ' ' . $user->surname,
                        'items' => [
                            ['label' => 'Настройки', 'url' => ['/user/update', 'id' => $user->id]],
                            ['label' => 'Выход', 'url' => ['/site/logout']],
                        ],
                        'linkOptions' => ['calss' => 'top-in-menu']
                    ],
                ];
            }

            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Главная', 'url' => ['/site/index']],
                    ...$menuItems
                ],
            ]);
            NavBar::end();
            ?>
            <?= $content ?>
        </div>
        <footer class="footer">
            <div class="container">
                <p class="pull-left"><?= date('Y') ?> &copy; АО Почта России (прототип IT animals, финал Цифрового прорыва 2020)</p>
            </div>
        </footer>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
