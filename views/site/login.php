<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row justify-content-center">
    <div class="col-sm-6 site-login list-item login-form">
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-1 control-label'],
            ],
        ]); ?>
        <div class="row justify-content-center">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>

        <div class="row">
            <?= $form->field($model, 'username' ,[
                    'inputTemplate' =>
                        '<div class="input-container">
                            <i class="glyphicon glyphicon-user icon"></i>
                            {input}
                         </div>',
                    'template' => '{input}{error}{hint}',
                ])
                ->textInput(['autofocus' => true,'placeholder' => 'Пользователь','class' => 'input-field'])
                ->label(false);
            ?>
        </div>

        <div class="row">
            <?= $form->field($model, 'password' ,[
                'inputTemplate' =>
                        '<div class="input-container">
                                <i class="glyphicon glyphicon-lock icon"></i>
                                {input}
                         </div>',
                'template' => '{input}{error}{hint}'
            ])
                ->passwordInput(['placeholder' => 'Пароль','class' => 'input-field'])
                ->label(false);
            ?>
        </div>

        <div class="row">
            <?= $form->field($model, 'rememberMe')->checkbox()->label("Запомнить меня") ?>
        </div>

        <div class="row">
            <?= Html::submitButton('Войти', ['class' => 'btn btn-info btn-login', 'name' => 'login-button']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
