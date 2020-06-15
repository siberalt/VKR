<?php

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\NameForm;

$show_actions = Yii::$app->user->identity->getRole() == User::$ROLE_WORKER;
if($show_actions) {
    $js = <<< JS
//Удаление элемента
$('tbody').on('click','.glyphicon-trash',function(e) {
    var row = $(this).closest('tr');
    var url = $(row).find('.delete').val();
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
})

//Изменение элемента
$('tbody').on('click','.glyphicon-pencil',function(e){
    item = $(this).closest('tr');
    url = $(item).find('.edit').val();
    $('#nameform-id').val($(item).find('.id').text());
    $('#nameform-name').val($(item).find('.name').text());
    create = false;
    $('#nameModal').modal('show');
})

$('#save').on('click',function(e) {
    $('#form').submit();
})

var item;
var id;
var url;
var create = false;

$('.add').on('click',function(e) {
    id = $(this).siblings('.id').val();
    url = $(this).siblings('.url').val();
    $('#nameform-id').val('');
    $('#nameform-name').val('');
    create = true;
});
    
$('#form').on('beforeSubmit',function(e) {
    //$(this).attr('action',url);
    e.preventDefault();

    var data = new FormData($(this)[0]);
    $.ajax({
			url: url,
			type: 'POST',
			data: data,
			success: function(res){
				if(create){
					var list = $(id);
					list.append(res);
					//alert('Данные добавлены!');
				}
				else {
					$(item).replaceWith(res);
					//alert('Данные обновленны!');
				}
			},
			error: function(msg){
				alert('Произошла какая-та ошибка.');
			},
			cache: false,
			contentType: false,
			processData: false
		});
    return false;
});


JS;

    $this->registerJs($js);
}

$this->title = 'Справочная информация учреждения';

$specialties = \app\models\Specialty::find()->all();
$statuses = \app\models\PublicationStatus::find()->all();
$results = \app\models\Result::find()->all();
$departments = \app\models\ReportingD::find()->all();
?>

<!--Name Modal Dialog-->
<?php if($show_actions): ?>
<div class="modal fade" id="nameModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Новое наименование</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $name_form = new \app\models\NameForm();
                $form = ActiveForm::begin([
                    'id' => 'form',
                    'action'=>'',
                    'options' => ['enctype' => 'multipart/form-data']
                ]) ?>
                <?= $form->field($name_form,'id')->hiddenInput()->label(false);?>
                <?= $form->field($name_form,'name')
                    ->textInput(['class'=>'form-control'])
                    ->label('Навание')?>

                <?php ActiveForm::end(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info btn-secondary" data-dismiss="modal"><i class="glyphicon glyphicon-log-out"></i> Закрыть</button>
                <button type="button" class="btn btn-success" id="save" data-dismiss="modal"><i class="glyphicon glyphicon-plus"></i> Сохранить</button>
            </div>
        </div>
    </div>
</div>
<?php endif;?>
<!---->

<div class="row">
    <div class="col">
        <h2><?= Html::encode($this->title) ?></h2>
    </div>
</div>

<div class="card card-margin">
    <div class="card-header card-header-text bg-info">
        Навигация по справочнику
    </div>
    <div class="card-body">
        <a class="nav-link" href="#specialties">Специальности</a>
        <a class="nav-link" href="#statuses">Статусы участника жюри</a>
        <a class="nav-link" href="#results">Результаты участия</a>
        <a class="nav-link" href="#departments">Отчётные кафедры</a>
    </div>
</div>

<div class="card card-margin" id="specialties">
    <div class="card-header card-header-text bg-info">
        <div class="row ">
            <div class="col">
                Специальности
            </div>
            <div class="col-auto">
                    <button class="btn btn-primary show"
                            type="button">
                        <i class="glyphicon glyphicon-arrow-up"> Наверх</i>
                    </button>
                    <?= Html::Button('<i class="glyphicon glyphicon-plus"></i> Добавить',
                        ['class' => 'btn btn-success add',
                            'name' => 'back-button',
                            'data-toggle'=>"modal",
                            'data-target'=>"#nameModal"]) ?>
                    <input class="id" name="id" type="hidden" value="#list-specialties">
                    <input class="url" name="url" type="hidden" value="<?=Url::to(['handbook/create','table'=>'Specialty','actions'=>$show_actions])?>">
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Наименование</th>
                <?php if($show_actions):?>
                    <th scope="col">Действия</th>
                <?php endif;?>
            </tr>
            </thead>
            <tbody id = "list-specialties">
            <?php foreach ($specialties as $i => $specialty):?>
                <?= $this->render('row',
                    [
                        'id'=>$specialty['id'],
                        'name'=>$specialty['name'],
                        'table'=>'Specialty',
                        'actions'=>$show_actions
                    ]); ?>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>

<div class="card card-margin" id="statuses">
    <div class="card-header card-header-text bg-info">
        <div class="row ">
            <div class="col">
                Статусы участника жюри
            </div>
            <div class="col-auto">
                <button class="btn btn-primary show"
                        type="button">
                    <i class="glyphicon glyphicon-arrow-up"> Наверх</i>
                </button>
                <?= Html::Button('<i class="glyphicon glyphicon-plus"></i> Добавить',
                    ['class' => 'btn btn-success add',
                        'name' => 'back-button',
                        'data-toggle'=>"modal",
                        'data-target'=>"#nameModal"]) ?>
                <input class="id" name="id" type="hidden" value="#list-statuses">
                <input class="url" name="url" type="hidden" value="<?=Url::to(['handbook/create','table'=>'Publication_status','actions'=>$show_actions])?>">
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Наименование</th>
                <?php if($show_actions):?>
                    <th scope="col">Действия</th>
                <?php endif;?>
            </tr>
            </thead>
            <tbody id="list-statuses">
            <?php foreach ($statuses as $i => $status):?>
                <?= $this->render('row',
                    [
                        'id'=>$status['id'],
                        'name'=>$status['name'],
                        'table'=>'Publication_status',
                        'actions'=>$show_actions
                    ]); ?>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>

<div class="card card-margin" id="results">
    <div class="card-header card-header-text bg-info">
        <div class="row ">
            <div class="col">
                Результаты участия
            </div>
            <div class="col-auto">
                <button class="btn btn-primary show"
                        type="button">
                    <i class="glyphicon glyphicon-arrow-up"> Наверх</i>
                </button>
                <?= Html::Button('<i class="glyphicon glyphicon-plus"></i> Добавить',
                    ['class' => 'btn btn-success add',
                        'name' => 'back-button',
                        'data-toggle'=>"modal",
                        'data-target'=>"#nameModal"]) ?>
                <input class="id" name="id" type="hidden" value="#list-results">
                <input class="url" name="url" type="hidden" value="<?=Url::to(['handbook/create','table'=>'Result','actions'=>$show_actions])?>">
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Наименование</th>
                <?php if($show_actions):?>
                    <th scope="col">Действия</th>
                <?php endif;?>
            </tr>
            </thead>
            <tbody id="list-results">
                <?php foreach ($results as $i => $result):?>
                    <?= $this->render('row',
                        [
                            'id'=>$result['id'],
                            'name'=>$result['name'],
                            'table'=>'Result',
                            'actions'=>$show_actions
                        ]); ?>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>

<div class="card card-margin" id="departments">
    <div class="card-header card-header-text bg-info">
        <div class="row ">
            <div class="col">
                Отчётные кафедры
            </div>
            <div class="col-auto">
                <button class="btn btn-primary show"
                        type="button">
                    <i class="glyphicon glyphicon-arrow-up"> Наверх</i>
                </button>
                <?= Html::Button('<i class="glyphicon glyphicon-plus"></i> Добавить',
                    ['class' => 'btn btn-success add',
                        'name' => 'back-button',
                        'data-toggle'=>"modal",
                        'data-target'=>"#nameModal"]) ?>
                <input class="id" name="id" type="hidden" value="#list-departments">
                <input class="url" name="url" type="hidden" value="<?=Url::to(['handbook/create','table'=>'Reporting_d','actions'=>$show_actions])?>">
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Наименование</th>
                <?php if($show_actions):?>
                    <th scope="col">Действия</th>
                <?php endif;?>
            </tr>
            </thead>
            <tbody id="list-departments">
                <?php foreach ($departments as $i => $department):?>
                    <?= $this->render('row',
                        [
                            'id'=>$department['id'],
                            'name'=>$department['name'],
                            'table'=>'Reporting_d',
                            'actions'=>$show_actions
                        ]); ?>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>

