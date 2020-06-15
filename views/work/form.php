<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Rank;
use \app\Helper;
use \app\models\Specialty;
?>

<?php $form = ActiveForm::begin([
    'id' => 'work_form',
    'layout' => 'horizontal',
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
]); ?>

    <input id="more" type="hidden" name="Work[more]">
    <?= $form->field($work,'id')->hiddenInput()->label(false); ?>
    <?= $form->field($work,'head_id')->hiddenInput(['value'=>Yii::$app->user->identity->id])->label(false); ?>
    <div class="row">
        <div class="col">
            <?= $form->field($work, 'name' ,[
                'inputTemplate' => Yii::$app->params['inputTemplate'],
                'template' => '{label}{input}{error}{hint}',
                'labelOptions' => [
                    'class' => 'col control-label',
                ]
            ])
                ->textInput(['autofocus' => true,'class' => 'input-field'])
                ->label('Название научной работы');
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <?= $form->field($work, 'students_names' ,[
                'inputTemplate' => Yii::$app->params['inputTemplate'],
                'template' => '{label}{input}{error}{hint}',
                'labelOptions' => [
                    'class' => 'col control-label',
                ]
            ])
                ->textarea(['class' => 'input-field','placeholder'=>'Образец: Иванов Алексей Петровович'])
                ->label('ФИО студентов');
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <?= $form->field($work, 'specialty_id' ,[
                'inputTemplate' => Yii::$app->params['inputTemplate'],
                'template' => '{label}{input}{error}{hint}',
                    'labelOptions' => [
                        'class' => 'col control-label',
                    ]
            ])
                ->dropDownList(Helper::comboList(new Specialty()),[])->label('Укрупненные группы специальностей');?>
        </div>
        <div class="col">
            <?= $form->field($work, 'number_group' ,[
                'inputTemplate' => Yii::$app->params['inputTemplate'],
                'template' => '{label}{input}{error}{hint}',
                'labelOptions' => [
                    'class' => 'col control-label',
                ]
            ])
                ->textInput(['class' => 'input-field','type'=>'number', 'placeholder'=>'Образец: 61',])
                ->label('Номер группы, в которой обучаются студенты');
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col">

            <?= $form->field($work, 'science_branch_id' ,[
                'inputTemplate' => Yii::$app->params['inputTemplate'],
                'template' => '{label}{input}{error}{hint}',
                'labelOptions' => [
                    'class' => 'col control-label',
                ]
            ])
                ->dropDownList(Helper::comboList(new \app\models\ScienceBranch()),[])->label('Отрасль науки');?>
        </div>
    </div>

    <div class="row">
        <div class="col">

            <?= $form->field($work, 'status_id' ,[
                'inputTemplate' => Yii::$app->params['inputTemplate'],
                'template' => '{label}{input}{error}{hint}',
                'labelOptions' => [
                    'class' => 'col control-label',
                ]
            ])
                ->dropDownList(Helper::comboList(new \app\models\PublicationStatus()),[])->label('Статус публикации');?>
        </div>
    </div>

<?php ActiveForm::end(); ?>