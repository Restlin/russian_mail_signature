<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container">

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if ($model->isAdmin) { ?>
            <?=
            Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы уверены что хотите удалить данного пользователя?',
                    'method' => 'post',
                ],
            ])
            ?>
        <?php } ?>
        <?= Html::a('Создать ЭП', ['create-e-sign', 'id' => $model->id], ['class' => 'btn btn-success', 'data-method' => 'post']) ?>
    </p>
    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'surname',
            'name',
            'patronymic',
            'phone',
            'email:email',
        ],
    ])
    ?>
</div>
