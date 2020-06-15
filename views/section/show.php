<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Научная секция';
$categories_f = \app\models\indicators\CategoryF::find()->all();
$tables_s = \app\models\indicators\TableS::find()->all();

$node_id = $node->id;

$type = ['time','remove','check'][$node->status_id-1];
$css_class = ['primary','danger','success'][$node->status_id-1];

$teacher_name = \app\models\User::findOne($section['teacher_id']);
$teacher_name = isset($teacher_name)? $teacher_name : 'Не указано';

$reporting_d = \app\models\ReportingD::findOne($section['reporting_d_id']);
$reporting_d = isset($reporting_d)? $reporting_d->name : 'Не указано';

$url_approve = "'".Url::to(['node/status','id'=>$node_id,'status'=>3])."'";
$url_deny = "'".Url::to(['node/status','id'=>$node_id,'status'=>2])."'";
$csrf = "'".Yii::$app->request->getCsrfToken()."'";

$js = <<< JS
$('#approve').on('click',function(e) {
    ajaxRequest($url_approve);
});

$('#deny').on('click',function(e) {
    ajaxRequest($url_deny);
})

function ajaxRequest(url){
    $.ajax({
			url: url,
			type: 'GET',
			success: function(res){
			    $('#status').replaceWith(res);
			},
			error: function(msg){
				alert('Произошла какая-та ошибка.');
			},
	});
}

$('#accordionStat').on('click','.check',function(e) {
    bind(this);
})

$('#accordionFinal').on('click','.check',function(e) {
    bind(this);
})

function bind(check) {
  url = $(check).siblings('.url').val();
    $.ajax({
            url: url,
            type: 'POST',
            data: {
                    _csrf: $csrf,
                    check: $(check).is(':checked')
                   },
            success: function(res){
			    //alert(res);
			},
			error: function(msg){
				alert('Произошла какая-та ошибка.');
			}
    })
}
JS;

$this->registerJs($js);

?>
<div class="row">
    <div class="col">
        <h2><?= Html::encode($this->title) ?></h2>
    </div>
</div>

<div class="card card-margin">
    <div class="card-header card-header-text bg-info">
        <div class="row">
            <div class="col">
                Общие сведения
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="container">
            <div class="row">
                <div class="col alert alert-<?= $css_class?>" role="alert" id="status">
                    Статус записи: <i class="glyphicon glyphicon-<?= $type?>"></i> <b><?= \app\models\Status::findOne($node->status_id)->name?></b>
                </div>
            </div>
            <div class="row"><span class="attribute">Название секции: </span><pre class="text"> <?= $section['name']?></pre></div>
            <div class="row"><span class="attribute">Количество студентов: </span><pre class="text"> <?= $section['amount']?></pre></div>
            <div class="row"><span class="attribute">Руководитель: </span><pre class="text"> <?= $teacher_name ?></pre></div>
            <div class="row"><span class="attribute">Отчётная кафедра: </span><pre class="text"> <?= $reporting_d?></pre></div>
            <div class="row"><span class="attribute">Дата записи: </span><pre class="text"> <?= $node->creation_date?></pre></div>
        </div>
        <?php if(Yii::$app->user->identity->getRole()==\app\models\User::$ROLE_WORKER):?>
        <div class="row justify-content-center">
            <button class="btn btn-success option-button" type="button" id="approve" >
                <i class="glyphicon glyphicon-check"></i> Принять
            </button>
            <button class="btn btn-danger option-button" type="button" id="deny">
                <i class="glyphicon glyphicon-remove" ></i> Отклонить
            </button>
        </div>
        <?php endif;?>
    </div>
</div>

<div class="card card-margin">
    <div class="card-header card-header-text bg-info">
        <div class="row">
            <div class="col">
                Привязка к итоговым показателям
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="accordion col" id="accordionFinal">
            <?php foreach ($categories_f as $i=>$category_f):?>
                <?= $this->render('..\f-category\check',compact(['node_id','category_f']))?>
            <?php endforeach;?>
        </div>
    </div>
</div>

<div class="card card-margin">
    <div class="card-header card-header-text bg-info">
        <div class="row">
            <div class="col">
                Привязка к статистическим показателям
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="accordion col" id="accordionStat">
            <?php foreach ($tables_s as $i=>$table_s):?>
                <?= $this->render('..\s-table\check',compact(['node_id','table_s']))?>
            <?php endforeach;?>
        </div>
    </div>
</div>