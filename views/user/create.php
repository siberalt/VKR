<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Добавление пользователя';

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
                <p> В данной форме указываются сведения для нового пользователя системы</p>
            </div>
        </div>

        <?= $this->render('form',compact(['user']))?>

        <hr class="line-style">

        <div class="row justify-content-center">
            <div class="col-sm-4">
                <?= Html::submitButton('<i class="glyphicon glyphicon-log-out"></i> Назад',
                    [
                        'class' => 'btn btn-info btn-login',
                        'name' => 'back-button',
                        'form'=>'user_form',
                        'onClick' => 'location.href="'.Url::previous().'"'
                        //'onClick'=> 'location.href='."'".Url::to(['user/create','more'=>false])."'"
                    ]) ?>
            </div>
            <div class="col-sm-4">
                <?= Html::submitButton('<i class="glyphicon glyphicon-plus"></i> Добавить',
                    [
                        'class' => 'btn btn-success btn-login',
                        'name' => 'add-button',
                        'form'=>'user_form',
                        'onClick'=> $add
                    ]) ?>
            </div>
            <div class="col-sm-4">
                <?= Html::submitButton('<i class="glyphicon glyphicon-plus"></i> Добавить ещё',
                    [
                        'class' => 'btn btn-success btn-login',
                        'name' => 'add-button',
                        'form'=>'user_form',
                        'onClick'=> $add_more
                    ])  ?>
            </div>
        </div>
    </div>
</div>
