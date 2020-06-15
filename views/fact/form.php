<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
?>

<?php $form = ActiveForm::begin([
    'id' => 'fact_form',
    'layout' => 'horizontal',
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
]); ?>

    <input id="more" type="hidden" name="Section[more]">
    <?= $form->field($fact,'id')->hiddenInput()->label(false); ?>
    <?= $form->field($fact,'user_id')->hiddenInput(['value'=>Yii::$app->user->identity->id])->label(false); ?>

    <div class="row">
        <div class="col">
            <?= $form->field($fact, 'name' ,[
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
            <?= $form->field($fact, 'event_type_id' ,[
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
            <?= $form->field($fact, 'event_level_id' ,[
                'inputTemplate' => Yii::$app->params['inputTemplate'],
                'template' => '{label}{input}{error}{hint}',
                'labelOptions' => [
                    'class' => 'col control-label',
                ]
            ])
                ->dropDownList(\app\Helper::comboList(new \app\models\EventType()),[])->label('Уровень мероприятия');?>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <?= $form->field($fact, 'specialty_id' ,[
                'inputTemplate' => Yii::$app->params['inputTemplate'],
                'template' => '{label}{input}{error}{hint}',
                'labelOptions' => [
                    'class' => 'col control-label',
                ]
            ])
                ->dropDownList(\app\Helper::comboList(new \app\models\Specialty()),[])->label('Укрупненные группы специальностей');?>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <?= $form->field($fact, 'place' ,[
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
            <?= $form->field($fact, 'time' ,[
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
            <?= $form->field($fact, 'science_branch_id' ,[
                'inputTemplate' => Yii::$app->params['inputTemplate'],
                'template' => '{label}{input}{error}{hint}',
                'labelOptions' => [
                    'class' => 'col control-label',
                ]
            ])
                ->dropDownList(\app\Helper::comboList(new \app\models\ScienceBranch()),[])->label('Отрасль науки');?>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <?= $form->field($fact, 'jury_status_id' ,[
                'inputTemplate' => Yii::$app->params['inputTemplate'],
                'template' => '{label}{input}{error}{hint}',
                'labelOptions' => [
                    'class' => 'col control-label',
                ]
            ])
                ->dropDownList(\app\Helper::comboList(new \app\models\JuryStatus()),[])->label('Статус участника жюри');?>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <?= $form->field($fact, 'reporting_d_id' ,[
                'inputTemplate' => Yii::$app->params['inputTemplate'],
                'template' => '{label}{input}{error}{hint}',
                'labelOptions' => [
                    'class' => 'col control-label',
                ]
            ])
                ->dropDownList(\app\Helper::comboList(new \app\models\ReportingD()),[])->label('Отчетная кафедра');?>
        </div>
    </div>

<?php ActiveForm::end(); ?>