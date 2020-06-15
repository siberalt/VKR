<?php

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Главная страница сотрудника ВУЗа';

$status_names = \app\models\Status::find()->all();

$sections = \app\models\node_types\Section::getList(null);
$sections1 = array_filter($sections,function ($var){ return $var['status_id'] == 1;});
$sections2 = array_filter($sections,function ($var){ return $var['status_id'] == 2;});
$sections3 = array_filter($sections,function ($var){ return $var['status_id'] == 3;});

$works = \app\models\node_types\Work::getList(null);
$works1 = array_filter($works,function ($var){ return $var['status_id'] == 1;});
$works2 = array_filter($works,function ($var){ return $var['status_id'] == 2;});
$works3 = array_filter($works,function ($var){ return $var['status_id'] == 3;});

$facts = \app\models\node_types\Fact::getList(null);
$facts1 = array_filter($facts,function ($var){ return $var['status_id'] == 1;});
$facts2 = array_filter($facts,function ($var){ return $var['status_id'] == 2;});
$facts3 = array_filter($facts,function ($var){ return $var['status_id'] == 3;});

$events = \app\models\node_types\Event::getList(null);
$events1 = array_filter($events,function ($var){ return $var['status_id'] == 1;});
$events2 = array_filter($events,function ($var){ return $var['status_id'] == 2;});
$events3 = array_filter($events,function ($var){ return $var['status_id'] == 3;});
?>


<div class="row">
    <div class="col">
        <h2><?= Html::encode($this->title) ?></h2>
    </div>
</div>

<div class="card card-margin" id="levels">
    <div class="card-header card-header-text bg-info">
        <div class="row">
            <div class="col">
                Справочная информация учрежедения
            </div>
        </div>
    </div>

    <div class="card-body">
        <a href="<?=Url::to(['handbook/university'])?>" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i> Изменить справочную информацию учреждения</a>
    </div>
</div>

<div class="card-header card-header-text bg-info">
    <div class="row">
        <div class="col">
            Учёт записей
        </div>
    </div>

    <ul class="row nav nav-tabs card-header-tabs">
        <li class="nav-item">
            <a class="nav-link active tab-link" data-toggle="tab" href="#tab-1"><?= $status_names[0]['name']?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link tab-link" data-toggle="tab" href="#tab-2"><?= $status_names[1]['name']?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link tab-link" data-toggle="tab" href="#tab-3"><?= $status_names[2]['name']?></a>
        </li>
    </ul>
</div>

<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="home-tab">
        <div class="worker-tab">
            <div class="card card-margin">
                <div class="card-header card-header-text bg-info">
                    Навигация по записям
                </div>
                <div class="card-body">
                    <a class="nav-link" href="#works-1">Научные работы</a>
                    <a class="nav-link" href="#sections-1">Секции</a>
                    <a class="nav-link" href="#events-1">Участия в мероприятиях</a>
                    <a class="nav-link" href="#facts-1">Факты участия в оргкомитетах</a>
                </div>
            </div>

            <div class="card card-margin" id="works-1">
                <div class="card-header card-header-text bg-info">
                    <div class="row ">
                        <div class="col">
                            Записи о научных работах
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Статус</th>
                            <th scope="col">Руководитель</th>
                            <th scope="col">Название работы</th>
                            <th scope="col">ФИО студентов</th>
                            <th scope="col">Дата записи</th>
                            <th scope="col">Действия</th>
                        </tr>
                        </thead>
                        <tbody id = "list-sections">
                        <?php foreach ($works1 as $i => $work):?>
                            <?= $this->render('..\work\row',
                                [
                                    'work'=>$work,
                                    'actions'=>false
                                ]); ?>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card card-margin" id="sections-1">
                <div class="card-header card-header-text bg-info">
                    <div class="row ">
                        <div class="col">
                            Записи о секциях
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Статус</th>
                            <th scope="col">Название секции</th>
                            <th scope="col">Руководитель</th>
                            <th scope="col">Количество студентов</th>
                            <th scope="col">Дата записи</th>
                            <th scope="col">Действия</th>
                        </tr>
                        </thead>
                        <tbody id = "list-sections">
                        <?php foreach ($sections1 as $i => $section):?>
                            <?= $this->render('..\section\row',
                                [
                                    'section'=>$section,
                                    'actions'=>false
                                ]); ?>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card card-margin" id="events-1" >
                <div class="card-header card-header-text bg-info">
                    <div class="row ">
                        <div class="col">
                            Записи о участии в мероприятиях
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Статус</th>
                            <th scope="col">Руководитель</th>
                            <th scope="col">Название мероприятия</th>
                            <th scope="col">Студенты</th>
                            <th scope="col">Дата записи</th>
                            <th scope="col">Действия</th>
                        </tr>
                        </thead>
                        <tbody id = "list-sections">
                        <?php foreach ($events1 as $i => $event):?>
                            <?= $this->render('..\event\row',
                                [
                                    'event'=>$event,
                                    'actions'=>false
                                ]); ?>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card card-margin" id="facts-1" >
                <div class="card-header card-header-text bg-info">
                    <div class="row ">
                        <div class="col">
                            Записи о фактах участия в оргкомитетах
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Статус</th>
                            <th scope="col">Руководитель</th>
                            <th scope="col">Название мероприятия</th>
                            <th scope="col">Место проведения</th>
                            <th scope="col">Дата записи</th>
                            <th scope="col">Действия</th>
                        </tr>
                        </thead>
                        <tbody id = "list-sections">
                        <?php foreach ($facts1 as $i => $fact):?>
                            <?= $this->render('..\fact\row',
                                [
                                    'fact'=>$fact,
                                    'actions'=>false
                                ]); ?>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="profile-tab">
        <div class="worker-tab">
            <div class="card card-margin">
                <div class="card-header card-header-text bg-info">
                    Навигация по записям
                </div>
                <div class="card-body">
                    <a class="nav-link" href="#works-2">Научные работы</a>
                    <a class="nav-link" href="#sections-2">Секции</a>
                    <a class="nav-link" href="#events-2">Участия в мероприятиях</a>
                    <a class="nav-link" href="#facts-2">Факты участия в оргкомитетах</a>
                </div>
            </div>

            <div class="card card-margin" id="works-2">
                <div class="card-header card-header-text bg-info">
                    <div class="row ">
                        <div class="col">
                            Записи о научных работах
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Статус</th>
                            <th scope="col">Руководитель</th>
                            <th scope="col">Название работы</th>
                            <th scope="col">ФИО студентов</th>
                            <th scope="col">Дата записи</th>
                            <th scope="col">Действия</th>
                        </tr>
                        </thead>
                        <tbody id = "list-sections">
                        <?php foreach ($works2 as $i => $work):?>
                            <?= $this->render('..\work\row',
                                [
                                    'work'=>$work,
                                    'actions'=>false
                                ]); ?>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card card-margin" id="sections-2">
                <div class="card-header card-header-text bg-info">
                    <div class="row ">
                        <div class="col">
                            Записи о секциях
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Статус</th>
                            <th scope="col">Название секции</th>
                            <th scope="col">Руководитель</th>
                            <th scope="col">Количество студентов</th>
                            <th scope="col">Дата записи</th>
                            <th scope="col">Действия</th>
                        </tr>
                        </thead>
                        <tbody id = "list-sections">
                        <?php foreach ($sections2 as $i => $section):?>
                            <?= $this->render('..\section\row',
                                [
                                    'section'=>$section,
                                    'actions'=>false
                                ]); ?>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card card-margin" id="events-2" >
                <div class="card-header card-header-text bg-info">
                    <div class="row ">
                        <div class="col">
                            Записи о участии в мероприятиях
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Статус</th>
                            <th scope="col">Руководитель</th>
                            <th scope="col">Название мероприятия</th>
                            <th scope="col">Студенты</th>
                            <th scope="col">Дата записи</th>
                            <th scope="col">Действия</th>
                        </tr>
                        </thead>
                        <tbody id = "list-sections">
                        <?php foreach ($events2 as $i => $event):?>
                            <?= $this->render('..\event\row',
                                [
                                    'event'=>$event,
                                    'actions'=>false
                                ]); ?>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card card-margin" id="facts-2" >
                <div class="card-header card-header-text bg-info">
                    <div class="row ">
                        <div class="col">
                            Записи о фактах участия в оргкомитетах
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Статус</th>
                            <th scope="col">Руководитель</th>
                            <th scope="col">Название мероприятия</th>
                            <th scope="col">Место проведения</th>
                            <th scope="col">Дата записи</th>
                            <th scope="col">Действия</th>
                        </tr>
                        </thead>
                        <tbody id = "list-sections">
                        <?php foreach ($facts2 as $i => $fact):?>
                            <?= $this->render('..\fact\row',
                                [
                                    'fact'=>$fact,
                                    'actions'=>false
                                ]); ?>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="tab-3" role="tabpanel" aria-labelledby="profile-tab">
        <div class="worker-tab">
            <div class="card card-margin">
                <div class="card-header card-header-text bg-info">
                    Навигация по записям
                </div>
                <div class="card-body">
                    <a class="nav-link" href="#works-3">Научные работы</a>
                    <a class="nav-link" href="#sections-3">Секции</a>
                    <a class="nav-link" href="#events-3">Участия в мероприятиях</a>
                    <a class="nav-link" href="#facts-3">Факты участия в оргкомитетах</a>
                </div>
            </div>

            <div class="card card-margin" id="works-3">
                <div class="card-header card-header-text bg-info">
                    <div class="row ">
                        <div class="col">
                            Записи о научных работах
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Статус</th>
                            <th scope="col">Руководитель</th>
                            <th scope="col">Название работы</th>
                            <th scope="col">ФИО студентов</th>
                            <th scope="col">Дата записи</th>
                            <th scope="col">Действия</th>
                        </tr>
                        </thead>
                        <tbody id = "list-sections">
                        <?php foreach ($works3 as $i => $work):?>
                            <?= $this->render('..\work\row',
                                [
                                    'work'=>$work,
                                    'actions'=>false
                                ]); ?>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card card-margin" id="sections-3">
                <div class="card-header card-header-text bg-info">
                    <div class="row ">
                        <div class="col">
                            Записи о секциях
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Статус</th>
                            <th scope="col">Название секции</th>
                            <th scope="col">Руководитель</th>
                            <th scope="col">Количество студентов</th>
                            <th scope="col">Дата записи</th>
                            <th scope="col">Действия</th>
                        </tr>
                        </thead>
                        <tbody id = "list-sections">
                        <?php foreach ($sections3 as $i => $section):?>
                            <?= $this->render('..\section\row',
                                [
                                    'section'=>$section,
                                    'actions'=>false
                                ]); ?>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card card-margin" id="events-3" >
                <div class="card-header card-header-text bg-info">
                    <div class="row ">
                        <div class="col">
                            Записи о участии в мероприятиях
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Статус</th>
                            <th scope="col">Руководитель</th>
                            <th scope="col">Название мероприятия</th>
                            <th scope="col">Студенты</th>
                            <th scope="col">Дата записи</th>
                            <th scope="col">Действия</th>
                        </tr>
                        </thead>
                        <tbody id = "list-sections">
                        <?php foreach ($events3 as $i => $event):?>
                            <?= $this->render('..\event\row',
                                [
                                    'event'=>$event,
                                    'actions'=>false
                                ]); ?>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card card-margin" id="facts-3" >
                <div class="card-header card-header-text bg-info">
                    <div class="row ">
                        <div class="col">
                            Записи о фактах участия в оргкомитетах
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Статус</th>
                            <th scope="col">Руководитель</th>
                            <th scope="col">Название мероприятия</th>
                            <th scope="col">Место проведения</th>
                            <th scope="col">Дата записи</th>
                            <th scope="col">Действия</th>
                        </tr>
                        </thead>
                        <tbody id = "list-sections">
                        <?php foreach ($facts3 as $i => $fact):?>
                            <?= $this->render('..\fact\row',
                                [
                                    'fact'=>$fact,
                                    'actions'=>false
                                ]); ?>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




