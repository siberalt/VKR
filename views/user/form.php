<?php

use app\models\Degree;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Rank;

?>

<?php $form = ActiveForm::begin([
    'id' => 'user_form',
    'layout' => 'horizontal',
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
]); ?>

    <input id="more" type="hidden" name="User[more]">

    <?= $form->field($user,'id')->hiddenInput()->label(false); ?>
    <!--ФИО-->
    <div class="row">
        <div class="col">
            <?= $form->field($user, 'name' ,[
                'inputTemplate' => Yii::$app->params['inputTemplate'],
                'template' => '{label}{input}{error}{hint}',
                'labelOptions' => [
                    'class' => 'col control-label',
                ],
            ])
                ->textInput(['autofocus' => true,'class' => 'input-field','placeholder'=>'Образец: Оладнн Михаил Иванович'])
                ->label('ФИО пользователя');
            ?>
        </div>
    </div>

    <!--Почта-->
    <div class="row">
        <div class="col">
            <?= $form->field($user, 'email' ,[
                'inputTemplate' => Yii::$app->params['inputTemplate'],
                'template' => '{label}{input}{error}{hint}',
                'labelOptions' => [
                    'class' => 'col control-label',
                ]
            ])
                ->textInput(['autofocus' => true,'class' => 'input-field','placeholder'=>'Образец: Oladin1990@mail.ru','type'=>'email'])
                ->label('Почта пользователя');
            ?>
        </div>
    </div>

    <!--Логин-->
    <div class="row">
        <div class="col">
            <?= $form->field($user, 'login' ,[
                'inputTemplate' => Yii::$app->params['inputTemplate'],
                'template' => '{label}{input}{error}{hint}',
                'labelOptions' => [
                    'class' => 'col control-label',
                ]
            ])
                ->textInput(['autofocus' => true,'class' => 'input-field','placeholder'=>'Образец: Oladin1990'])
                ->label('Логин пользователя');
            ?>
        </div>
    </div>

    <!--Пароль-->
    <div class="row">
        <div class="col">
            <?= $form->field($user, 'password' ,[
                'inputTemplate' => Yii::$app->params['inputTemplate'],
                'template' => '{label}{input}{error}{hint}',
                'labelOptions' => [
                    'class' => 'col control-label',
                ]
            ])
                ->textInput(['autofocus' => true,'class' => 'input-field','type'=>'password'])
                ->label('Пароль пользователя');
            ?>
        </div>
    </div>

    <!--Должность-->
    <div class="row">
        <div class="col">
            <?= $form->field($user, 'position' ,[
                'inputTemplate' => Yii::$app->params['inputTemplate'],
                'template' => '{label}{input}{error}{hint}',
                'labelOptions' => [
                    'class' => 'col control-label',
                ]
            ])
                ->textInput(['autofocus' => true,'class' => 'input-field','placeholder'=>'Образец: Оладнн Михаил Иванович'])
                ->label('Должность');
            ?>
        </div>
    </div>

    <!--Ученая степень-->
    <div class="row">
        <div class="col">
            <?= $form->field($user, 'degree_id' ,[
                'inputTemplate' => Yii::$app->params['inputTemplate'],
                'template' => '{label}{input}{error}{hint}',
                'labelOptions' => [
                    'class' => 'col control-label',
                ]
            ])
                ->dropDownList([null=>'Не указано'] + ArrayHelper::map(\app\models\Degree::find()->all(), 'id', 'name'),[])->label('Ученая степень пользователя');?>
        </div>
    </div>

    <!--Ученое звание-->
    <div class="row">
        <div class="col">
            <?= $form->field($user, 'rank_id' ,[
                'inputTemplate' => Yii::$app->params['inputTemplate'],
                'template' => '{label}{input}{error}{hint}',
                'labelOptions' => [
                    'class' => 'col control-label',
                ]
            ])
                ->dropDownList([null=>'Не указано'] + ArrayHelper::map(\app\models\Rank::find()->all(), 'id', 'name'),[])->label('Ученое звание пользователя');?>
        </div>
    </div>

    <!--Тип пользователя-->
    <div class="row">
        <div class="col">
            <?= $form->field($user, 'user_type_id' ,[
                'inputTemplate' => Yii::$app->params['inputTemplate'],
                'template' => '{label}{input}{error}{hint}',
                'labelOptions' => [
                    'class' => 'col control-label',
                ]
            ])
                ->dropDownList( ArrayHelper::map(\app\models\UserType::find()->all(), 'id', 'name'),[])
                ->label('Тип пользователя');?>
        </div>
    </div>

<?php ActiveForm::end(); ?>