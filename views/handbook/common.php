<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\NameForm;
use \app\models\User;

$show_actions = Yii::$app->user->identity->getRole() == User::$ROLE_ADMIN;
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
});

//Изменение элемента
$('tbody').on('click','.glyphicon-pencil',function(e){
    item = $(this).closest('tr');
    url = $(item).find('.edit').val();
    $('#nameform-id').val($(item).find('.id').text());
    $('#nameform-name').val($(item).find('.name').text());
    create = false;
    $('#nameModal').modal('show');
});

$('#save').on('click',function(e) {
    $('#form').submit();
});

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

$this->title = 'Общая справочная информация';

$event_levels = \app\models\EventLevel::find()->all();
$event_types = \app\models\EventType::find()->all();
$statuses = \app\models\PublicationStatus::find()->all();
$ranks = \app\models\Rank::find()->all();
$degrees = \app\models\Degree::find()->all();
$branches = \app\models\ScienceBranch::find()->all();
?>

<!--Name Modal Dialog-->
<?php if($show_actions) :?>
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
        Навигация по справочнку
    </div>
    <div class="card-body">

        <a class="nav-link" href="#levels">Уровни мероприятий</a>
        <a class="nav-link" href="#types">Виды мероприятий</a>
        <a class="nav-link" href="#statuses">Статусы публикации</a>
        <a class="nav-link" href="#ranks">Научные звания</a>
        <a class="nav-link" href="#degrees">Ученые степени</a>
        <a class="nav-link" href="#branches">Отрасли науки</a>

    </div>
</div>

<div class="card card-margin" id="levels">
    <div class="card-header card-header-text bg-info">
        <div class="row">
            <div class="col">
                Уровни мероприятий
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
                <input class="id" name="id" type="hidden" value="#list-levels">
                <input class="url" name="url" type="hidden" value="<?=Url::to(['handbook/create','table'=>'Event_level','actions'=>$show_actions])?>">
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
            <tbody id="list-levels">
            <?php foreach ($event_levels as $i => $level):?>
                <?= $this->render('row',
                    [
                        'id'=>$level['id'],
                        'name'=>$level['name'],
                        'table'=>'Event_level',
                        'actions'=>$show_actions
                    ]);
                ?>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>

<div class="card card-margin" id="types">
    <div class="card-header card-header-text bg-info">
        <div class="row ">
            <div class="col">
                Виды мероприятий
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
                <input class="id" name="id" type="hidden" value="#list-types">
                <input class="url" name="url" type="hidden" value="<?=Url::to(['handbook/create','table'=>'Event_type','actions'=>$show_actions])?>">
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
            <tbody id = "list-types">
            <?php foreach ($event_types as $i => $type):?>
                <?= $this->render('row',
                    [
                        'id'=>$type['id'],
                        'name'=>$type['name'],
                        'table'=>'Event_type',
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
                Статусы публикации
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

<div class="card card-margin" id="ranks">
    <div class="card-header card-header-text bg-info">
        <div class="row ">
            <div class="col">
                Научные звания
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
                <input class="id" name="id" type="hidden" value="#list-ranks">
                <input class="url" name="url" type="hidden" value="<?=Url::to(['handbook/create','table'=>'Rank','actions'=>$show_actions])?>">
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
            <tbody id="list-ranks">
            <?php foreach ($ranks as $i => $rank):?>
                <?= $this->render('row',
                    [
                        'id'=>$rank['id'],
                        'name'=>$rank['name'],
                        'table'=>'Rank',
                        'actions'=>$show_actions
                    ]); ?>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>

<div class="card card-margin" id="degrees">
    <div class="card-header card-header-text bg-info">
        <div class="row">
            <div class="col">
                Ученые степени
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
                <input class="id" name="id" type="hidden" value="#list-degrees">
                <input class="url" name="url" type="hidden" value="<?=Url::to(['handbook/create','table'=>'Degree','actions'=>$show_actions])?>">
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
            <tbody id="list-degrees">
            <?php foreach ($degrees as $i => $degree):?>
                <?= $this->render('row',
                    [
                        'id'=>$degree['id'],
                        'name'=>$degree['name'],
                        'table'=>'Degree',
                        'actions'=>$show_actions
                    ]); ?>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>

<div class="card card-margin" id="branches">
    <div class="card-header card-header-text bg-info">
        <div class="row ">
            <div class="col">
                Отрасли науки
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
                <input class="id" name="id" type="hidden" value="#list-branches">
                <input class="url" name="url" type="hidden" value="<?=Url::to(['handbook/create','table'=>'Science_branch','actions'=>$show_actions])?>">
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
            <tbody id="list-branches">
            <?php foreach ($branches as $i => $branch):?>
                <?= $this->render('row',
                    [
                        'id'=>$branch['id'],
                        'name'=>$branch['name'],
                        'table'=>'Science_branch',
                        'actions'=>$show_actions
                    ]); ?>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
