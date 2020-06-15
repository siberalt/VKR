<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = "Главная страница администратора";

$teachers = \app\models\User_::find()->where(['user_type_id' => 1])->all();
$admins = \app\models\User_::find()->where(['user_type_id' => 2])->all();
$workers = \app\models\User_::find()->where(['user_type_id' => 3])->all();

Url::remember();

$js = <<< JS
//Удаление элемента
$('.list').on('click','.delete',function(e) {
    var result = confirm('Вы уверенны, что хотите удалить данного пользователя?');
    if(!result) return;
    var row = $(this).closest('.list-item');
    var url = $(this).siblings('.url').val();
    $.ajax({
			url: url,
			type: 'GET',
			success: function(res){
			    row.remove();
			},
			error: function(msg){
				alert('Произошла какая-та ошибка.');
			},
	});
});


JS;

$this->registerJs($js);

?>
<div class="row ">
    <div class="col">
        <h2><?= Html::encode($this->title) ?></h2>
    </div>
</div>

<div class="card card-margin" id="levels">
    <div class="card-header card-header-text bg-info">
        <div class="row">
            <div class="col">
                Общая справочная информация
            </div>

        </div>
    </div>

    <div class="card-body">
        <a href="<?=Url::to(['handbook/common'])?>" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i> Изменить общую справочную информацию</a>
    </div>
</div>

<div class="card card-margin" >
    <div class="card-header card-header-text bg-info">
        <div class="row">
            <div class="col">
                Управление пользователями
            </div>
            <div class="col-auto">
                <?= Html::Button('<i class="glyphicon glyphicon-plus"></i> Добавить пользователя',
                    ['class' => 'btn btn-success btn-buttom',
                        'name' => 'back-button',
                        'onClick'=> 'location.href='."'".Url::to(['user/create'])."'"
                    ]) ?>
            </div>
        </div>

            <ul class="row nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active tab-link" data-toggle="tab" href="#tab-teachers">Преподаватели</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link tab-link" data-toggle="tab" href="#tab-admins">Администраторы</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link tab-link" data-toggle="tab" href="#tab-workers">Сотрудники ВУЗа</a>
                </li>
            </ul>

    </div>



    <div class=""><!--
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#tab-teachers" role="tab" aria-controls="home" aria-selected="true">Преподаватели</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#tab-admins" role="tab" aria-controls="profile" aria-selected="false">Администраторы</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#tab-workers" role="tab" aria-controls="profile" aria-selected="false">Сотрудники вуза</a>
            </li>
        </ul>-->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-teachers" role="tabpanel" aria-labelledby="home-tab">
                <div id="teacher_list" class="list">
                    <?php foreach ($teachers as $i => $teacher):?>
                        <?= $this->render('..\teacher\row' ,['user'=>$teacher])?>
                    <?php endforeach;?>
                </div>
            </div>
            <div class="tab-pane fade" id="tab-admins" role="tabpanel" aria-labelledby="profile-tab">
                <div id="student_list" class="list">
                    <?php foreach ($admins as $i => $admin):?>
                        <?= $this->render('..\admin\row' ,['user'=>$admin])?>
                    <?php endforeach;?>
                </div>
            </div>
            <div class="tab-pane fade" id="tab-workers" role="tabpanel" aria-labelledby="profile-tab">
                <div id="worker_list" class="list">
                    <?php foreach ($workers as $i => $worker):?>
                        <?= $this->render('..\worker\row' ,['user'=>$worker])?>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
</div>


