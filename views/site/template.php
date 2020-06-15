<?php
use yii\helpers\Html;
$this->title = 'Создание записи об научном мероприятии'
?>

<div class="row">
    <h2><?= Html::encode($this->title) ?></h2>
</div>

<div class ="row">
    <div class="col-sm-10 site-login">
        <div class="col">
            <div class="row alert alert-info" role="alert">
                <h4 class="alert-heading">Информация о форме <i class="glyphicon glyphicon-info-sign"></i> </h4>
                <p> Данная форма предназначена для записи сведения о научной секции (кружке,клубе,лабаротории), руководтелем которой Вы являетсь.</p>
            </div>
        </div>

        <?= $this->render('../event/form',compact(['event']))?>

        <hr class="line-style">

        <div class="row justify-content-center">
            <div class="col-sm-4">
            <?= Html::submitButton('<i class="glyphicon glyphicon-log-out"></i> Назад', ['class' => 'btn btn-info btn-login', 'name' => 'back-button']) ?>
            </div>
            <div class="col-sm-4">
            <?= Html::submitButton('<i class="glyphicon glyphicon-plus"></i> Добавить', ['class' => 'btn btn-success btn-login', 'name' => 'add-button','form'=>'work_form']) ?>
            </div>
            <div class="col-sm-4">
            <?= Html::submitButton('<i class="glyphicon glyphicon-plus"></i> Добавить ещё', ['class' => 'btn btn-success btn-login ', 'name' => 'add-button','form'=>'work_form']) ?>
            </div>
        </div>
    </div>
</div>
