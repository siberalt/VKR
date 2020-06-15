<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Rank;
?>

<?php $form = ActiveForm::begin([
    'id' => 'event_form',
    'layout' => 'horizontal',
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
]); ?>
    <input id="more" type="hidden" name="Event[more]">
    <?= $form->field($event,'id')->hiddenInput()->label(false); ?>
    <?= $form->field($event,'teacher_id')->hiddenInput(['value'=>Yii::$app->user->identity->id])->label(false); ?>


    <div class="row">
        <div class="col">
            <?= $form->field($event, 'name' ,[
                'inputTemplate' => Yii::$app->params['inputTemplate'],
                'template' => '{label}{input}{error}{hint}',
                'labelOptions' => [
                    'class' => 'col control-label',
                ]
            ])
                ->textarea(['autofocus' => true,'class' => 'input-field','placeholder'=>'Образец: Олимпиада по русскому языку "Русич"'])
                ->label('Полное название мероприятия');
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <?= $form->field($event, 'event_type_id' ,[
                'inputTemplate' => Yii::$app->params['inputTemplate'],
                'template' => '{label}{input}{error}{hint}',
                'labelOptions' => [
                    'class' => 'col control-label',
                ]
            ])
                ->dropDownList(\app\Helper::comboList(new \app\models\EventType()),[])->label('Вид мероприятия');?>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <?= $form->field($event, 'event_level_id' ,[
                'inputTemplate' => Yii::$app->params['inputTemplate'],
                'template' => '{label}{input}{error}{hint}',
                'labelOptions' => [
                    'class' => 'col control-label',
                ]
            ])
                ->dropDownList(\app\Helper::comboList(new \app\models\EventLevel()),[])->label('Уровень мероприятия');?>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <?= $form->field($event, 'students_names' ,[
                'inputTemplate' => Yii::$app->params['inputTemplate'],
                'template' => '{label}{input}{error}{hint}',
                'labelOptions' => [
                    'class' => 'col control-label',
                ]
            ])
                ->textarea(['class' => 'input-field','placeholder'=>'Образец: Иванов Петр Васильевич'])
                ->label('ФИО студентов');
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <?= $form->field($event, 'specialty_id' ,[
                'inputTemplate' => Yii::$app->params['inputTemplate'],
                'template' => '{label}{input}{error}{hint}',
                'labelOptions' => [
                    'class' => 'col control-label',
                ]
            ])
                ->dropDownList(\app\Helper::comboList(new \app\models\Specialty()),[])->label('Укрупненные группы специальностей');?>
        </div>
        <div class="col">
            <?= $form->field($event, 'number_group' ,[
                'inputTemplate' => Yii::$app->params['inputTemplate'],
                'template' => '{label}{input}{error}{hint}',
                'labelOptions' => [
                    'class' => 'col control-label',
                ]
            ])
                ->textInput(['class' => 'input-field','type'=>'number'])
                ->label('Номер группы, в которой обучаются студенты');
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <?= $form->field($event, 'place' ,[
                'inputTemplate' => Yii::$app->params['inputTemplate'],
                'template' => '{label}{input}{error}{hint}',
                'labelOptions' => [
                    'class' => 'col control-label',
                ]
            ])
                ->textInput(['class' => 'input-field'])
                ->label('Место проведения');?>
        </div>
        <div class="col">
            <?= $form->field($event, 'time' ,[
                'inputTemplate' => Yii::$app->params['inputTemplate'],
                'template' => '{label}{input}{error}{hint}',
                'labelOptions' => [
                    'class' => 'col control-label',
                ]
            ])
                ->textInput(['class' => 'input-field','type'=>'date'])
                ->label('Время проведения');
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <?= $form->field($event, 'science_branch_id' ,[
                'inputTemplate' => Yii::$app->params['inputTemplate'],
                'template' => '{label}{input}{error}{hint}',
                'labelOptions' => [
                    'class' => 'col control-label',
                ]
            ])
                ->dropDownList(\app\Helper::comboList(new \app\models\ScienceBranch()),[])->label('Отрасль науки');?>
        </div>
    </div>

<?php ActiveForm::end(); ?>