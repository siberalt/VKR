<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

$main_page = '';
if(Yii::$app->user->identity!=null)
if(Yii::$app->user->identity->getRole() == \app\models\User::$ROLE_ADMIN){
    $main_page = Url::to(['admin/main']);
}
else if(Yii::$app->user->identity->getRole() == \app\models\User::$ROLE_TEACHER){
    $main_page = Url::to(['teacher/main']);
}
else {
    $main_page = Url::to(['worker/main']);
}

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
    <nav class="navbar navbar-expand-lg navbar-dark bg-info main-menu">
        <a class="brand navbar-brand" href="<?=  $main_page?>"> <i class="glyphicon glyphicon-education"></i> Главная </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Справочники
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?= Url::to(['handbook/university']);?>">Справочная информация ВУЗа</a>
                        <a class="dropdown-item" href="<?= Url::to(['handbook/common']);?>">Общая справочная информация</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Пользователи
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Преподаватели</a>
                        <a class="dropdown-item" href="#">Сотрудники ВУЗа</a>
                        <a class="dropdown-item" href="#">Администраторы</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Учебная деятельность
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?= Url::to(['work/index'])?>">Научные работы</a>
                        <a class="dropdown-item" href="<?= Url::to(['section/index'])?>">Научные секции</a>
                        <a class="dropdown-item" href="<?= Url::to(['fact/index'])?>">Участия в оргкомитетах</a>
                        <a class="dropdown-item" href="<?= Url::to(['event/index'])?>">Участия в мероприятиях</a>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::to(['site/indicators']);?>">Статистика</a>
                </li>
                <?php if (!Yii::$app->user->isGuest): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="glyphicon glyphicon-user"></i> <?= Yii::$app->user->identity->login?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Профиль</a>
                        <a class="dropdown-item" href="#">Настройки</a>
                        <div class="dropdown-divider"></div>

                            <?= Html::a('Выход', ["site/logout"], [
                                  'data' => [
                                      'method' => 'post'
                                   ], 'class' => 'dropdown-item']) ?>

                    </div>
                </li>
                <?php endif; ?>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Поиск на сайте" aria-label="Search">
                <button class="btn btn-light my-2 my-sm-0" type="submit"><i class="glyphicon glyphicon-search"></i> Найти</button>
            </form>
        </div>
    </nav>

    <div class="container">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
