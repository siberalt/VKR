<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Создание записи о научной секции';

$add = <<< JS
$('#more').attr('value',0);
JS;

$add_more = <<< JS
$('#more').attr('value',1);
JS;
?>

<div class="row">
    <h2><?= Html::encode($this->title) ?></h2>
</div>

<div class ="row">
    <div class="col-sm-10 site-login">
        <div class="col">
            <div class="row alert alert-info" role="alert">
                <h4 class="alert-heading">Информация о форме <i class="glyphicon glyphicon-info-sign"></i> </h4>
                <p> Данная форма предназначена для записи сведения о научной секции (кружке,клубе,лабаротории), руководтелем которой Вы являетсь</p>
                <hr>
            </div>
        </div>
        <?= $this->render('form',compact(['section']))?>

        <hr class="line-style">

        <div class="row justify-content-center">
            <div class="col-sm-4">
                <?= Html::submitButton('<i class="glyphicon glyphicon-log-out"></i> Назад',
                    [
                        'class' => 'btn btn-info btn-login',
                        'name' => 'back-button',
                        'onClick' => 'location.href="'.Url::previous().'"'
                    ]) ?>
            </div>
            <div class="col-sm-4">
                <?= Html::submitButton('<i class="glyphicon glyphicon-plus"></i> Добавить',
                    [
                        'class' => 'btn btn-success btn-login',
                        'name' => 'add-button',
                        'form'=>'section_form',
                        'onClick'=> $add
                    ]) ?>
            </div>
            <div class="col-sm-4">
                <?= Html::submitButton('<i class="glyphicon glyphicon-plus"></i> Добавить ещё',
                    [
                        'class' => 'btn btn-success btn-login',
                        'name' => 'add-button',
                        'form'=>'section_form',
                        'onClick'=> $add_more
                    ]) ?>
            </div>
        </div>
    </div>
</div>