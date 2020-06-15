<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $title;

$add = <<< JS
$('#user_form').attr('value',false);
JS;

$add_more = <<< JS
$('#more').attr('value',true);
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
                <p> В данной форме отображены сведения о пользователе системы</p>
            </div>
        </div>

        <?= $this->render('form',compact(['user']))?>

        <hr class="line-style">

        <div class="row justify-content-center">
            <div class="col-sm-4">
                <?= Html::Button('<i class="glyphicon glyphicon-log-out"></i> Назад',
                    [
                        'class' => 'btn btn-info btn-login',
                        'name' => 'back-button',
                        'form'=>'user_form',
                        'onClick' => 'location.href="'.Url::previous().'"'
                    ]) ?>
            </div>
            <div class="col-sm-4">
                <?= Html::submitButton('<i class="glyphicon glyphicon-plus"></i> Сохранить',
                    [
                        'class' => 'btn btn-success btn-login',
                        'name' => 'add-button',
                        'form'=>'user_form',
                    ]) ?>
            </div>
        </div>
    </div>
</div>
