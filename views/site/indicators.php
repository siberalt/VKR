<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use \app\models\indicators\FinalIndicator;

$this->title = 'Статистика';
$categories_f = \app\models\indicators\CategoryF::find()->all();
$list =[];
$weight_sum = 0;
$amount_sum = 0;
$total_sum = 0;
foreach ($categories_f as $i=>$category_f){
    $indicators = FinalIndicator::find()->where(['category_f_id'=>$category_f->id])->all();
    $items = [];

    foreach ($indicators as $j=>$indicator){
        $row = $items[$j] = $indicator->getRow();
        $amount_sum += $row['amount'];
        $weight_sum += $row['weight'];
        $total_sum += $row['total'];
    }
    $list[$i] = ['category' => $category_f, 'items'=>$items];
}

$create_category_f = URL::to(['f-category/create']);
$create_table_s = URL::to(['s-table/create']);
$js = <<< JS

var id;
var url;
var create;
var item;

//Скрипты для итоговых показателей

//Добавление итогового показателя
$('#accordionFinal').on('click','.add-indicator',function(e){
    url = $(this).siblings('.add').val();
    id = $(this).siblings('.table-id').val();
    $('#finalindicator-id').val('');
    $('#finalindicator-name').val('');
    $('#finalindicator-weight').val('');
    create = true;
    $('#final-modal').modal('show');
});

//Удаление итогового показателя
$('#accordionFinal').on('click','.glyphicon-trash',function(e) {
    url = $(this).siblings('.delete').val();
    remove($(this).closest('tr'));
})

//Редактирование итогового показателя
$('#accordionFinal').on('click','.glyphicon-pencil',function(e) {
    url = $(this).siblings('.edit').val();
    item = $(this).closest('tr');
    $('#finalindicator-name').val($(item).find('.name').text());
    $('#finalindicator-weight').val($(item).find('.weight').text());
    create = false;
    $('#final-modal').modal('show');
})

$('#save-final').on('click',function(e) {
    $('#final-form').submit();
})

$('#final-form').on('beforeSubmit',function(e){
    e.preventDefault();
    createUpdate(this);
    return false;
});

$('#save').on('click',function(e) {
    $('#name-form').submit();
});

$('#name-form').on('beforeSubmit',function(e) {
    e.preventDefault();
    createUpdate(this);
    return false;
});

//Удаление итоговой категории
$('#accordionFinal').on('click','.delete-category',function(e) {
    url = $(this).siblings('.delete').val();
    var row = $(this).closest('.card');
    remove(row);
});

//Редактирование итоговой категории
$('#accordionFinal').on('click','.edit-category',function(e) {
    url = $(this).siblings('.edit').val();
    $('#nameform-name').val($(this).siblings('.name').val());
    item = $(this).closest('.card');
    create = false;
    $('#name-modal').modal('show');
});

//Добавить итоговую категорию
$('#add-f-category').on('click',function(e) {
    $('#nameform-id').val('');
    $('#nameform-name').val('');
    url = "$create_category_f";
    id = "#accordionFinal";
    //alert(url);
    create = true;
    $('#name-modal').modal('show');
});

//Добавить статистическую таблицу 
$('#add-s-table').on('click',function(e) {
    $('#nameform-id').val('');
    $('#nameform-name').val('');
    url = "$create_table_s";
    id = "#accordionStat";
    //alert(url);
    create = true;
    $('#name-modal').modal('show');
});

//Удаление статистической таблицы
$('#accordionStat').on('click','.delete-table',function(e) {
    url = $(this).siblings('.delete').val();
    var row = $(this).closest('.card');
    remove(row);
});

//Редактирование статистической таблицы
$('#accordionStat').on('click','.edit-table',function(e) {
    url = $(this).siblings('.edit').val();
    $('#nameform-name').val($(this).siblings('.name').val());
    item = $(this).closest('.card');
    create = false;
    $('#name-modal').modal('show');
});

//Добавить статистическую категорию
$('#accordionStat').on('click','.add-category',function(e){
    url = $(this).siblings('.add').val();
    id = $(this).siblings('.table-id').val();
    $('#nameform-id').val('');
    $('#nameform-name').val('');
    create = true;
    $('#name-modal').modal('show');
});

//Удалить статистическую категорию
$('#accordionStat').on('click','.delete-category',function(e) {
    url = $(this).siblings('.delete').val();
    var row = $(this).closest('.card');
    remove(row);
});

//Редактирование статистической категории
$('#accordionStat').on('click','.edit-category',function(e) {
    url = $(this).siblings('.edit').val();
    $('#nameform-name').val($(this).siblings('.name').val());
    item = $(this).closest('.category-item');
    create = false;
    $('#name-modal').modal('show');
});

//Добавление статистического показателя
$('#accordionStat').on('click','.add-indicator',function(e){
    url = $(this).siblings('.add').val();
    id = $(this).siblings('.table-id').val();
    $('#nameform-name').val('');
    create = true;
    $('#name-modal').modal('show');
});

//Удаление статистического показателя
$('#accordionStat').on('click','.glyphicon-trash',function(e) {
    url = $(this).siblings('.delete').val();
    remove($(this).closest('tr'));
})

//Редактирование статистического показателя
$('#accordionStat').on('click','.glyphicon-pencil',function(e) {
    url = $(this).siblings('.edit').val();
    item = $(this).closest('tr');
    $('#name-name').val($(item).find('.name').text());
    create = false;
    $('#name-modal').modal('show');
})


function remove(row){
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
}

function createUpdate(el){
    var data = new FormData($(el)[0]);
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
}

JS;

$this->registerJs($js);

?>

<!--Name Modal Dialog-->
<div class="modal fade" id="name-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Новая итоговая категория</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $name = new \app\models\NameForm();
                $name_form = ActiveForm::begin([
                    'id' => 'name-form',
                    'options' => ['enctype' => 'multipart/form-data']
                ]) ?>
                <?= $name_form->field($name,'id')
                    ->hiddenInput()->label(false)?>
                <?= $name_form->field($name,'name')
                    ->textInput(['class'=>'form-control'])
                    ->label('Название')?>

                <?php ActiveForm::end(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info btn-secondary" data-dismiss="modal"><i class="glyphicon glyphicon-log-out"></i> Закрыть</button>
                <button type="button" class="btn btn-success" id="save"  data-dismiss="modal"><i class="glyphicon glyphicon-floppy-disk"></i> Сохранить</button>
            </div>
        </div>
    </div>
</div>

<!--Final indicator Dialog-->
<div class="modal fade" id="final-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Новый итоговый показатель</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $indicator = new \app\models\indicators\FinalIndicator();
                $indicator_form = ActiveForm::begin([
                    'id' => 'final-form',
                    'options' => ['enctype' => 'multipart/form-data']
                ]) ?>
                <?= $indicator_form->field($indicator,'id')
                    ->hiddenInput()->label(false)?>
                <?= $indicator_form->field($indicator,'name')
                    ->textInput(['class'=>'form-control'])
                    ->label('Наименование')?>
                <?= $indicator_form->field($indicator,'weight')
                    ->textInput(['class'=>'form-control','type'=>'number'])
                    ->label('Весовой коэффициент')?>

                <?php ActiveForm::end(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info btn-secondary" data-dismiss="modal"><i class="glyphicon glyphicon-log-out"></i> Закрыть</button>
                <button type="button" class="btn btn-success" id="save-final" data-dismiss="modal"><i class="glyphicon glyphicon-floppy-disk"></i> Сохранить</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <h2>Итоговые показатели</h2>
    </div>
    <div class="col-auto">
        <?= Html::Button('<i class="glyphicon glyphicon-plus"></i> Добавить категорию',
                [
                    'id' => 'add-f-category',
                    'class' => 'btn btn-success btn-buttom',
                ]) ?>
    </div>
</div>

<div class="row">
    <div class="accordion col" id="accordionFinal">
        <?php foreach ($list as $i=>$element):?>
            <?= $this->render('..\f-category\row',['category_f'=>$element['category'],'indicators_f'=>$element['items']]);?>
        <?php endforeach; ?>
        <div class="card">
            <div class="card-header bg-secondary" id="heading1">
                <div class="row justify-content-between">
                    <div class="col">
                        <h2 class="mb-0 card-header-text">
                            <button class="btn btn-link btn-block text-left card-header-text" type="button" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                Суммарные значения
                            </button>
                        </h2>
                    </div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">Сумма коэфициентов показателей</th>
                    <th scope="col">Суммарное количество</th>
                    <th scope="col">Суммарный итог</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row"></th>
                    <td align="right">Итого: </td>
                    <td><?= $weight_sum?></td>
                    <td><?= $amount_sum?></td>
                    <td><?= $total_sum?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="row collapse-margin">
    <div class="col">
        <h2>Статистические показатели</h2>
    </div>
    <div class="col-auto">
        <?= Html::Button('<i class="glyphicon glyphicon-plus"></i> Добавить таблицу',
                [
                    'class' => 'btn btn-success btn-buttom',
                    'id' => 'add-s-table',
                ]) ?>
    </div>
</div>

<!---->
<?php
$tables_s = \app\models\indicators\TableS::find()->all();
?>

<div class="row">
    <div class="accordion col" id="accordionStat">
        <?php foreach ($tables_s as $i=>$table_s):?>
            <?= $this->render('..\s-table\row',compact('table_s'))?>
        <?php endforeach;?>
    </div>
</div>
