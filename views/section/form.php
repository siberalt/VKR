<?php

use app\Helper;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Rank;
?>

<?php $form = ActiveForm::begin([
    'id' => 'section_form',
    'layout' => 'horizontal',
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
]); ?>

    <input id="more" type="hidden" name="Section[more]">
    <?= $form->field($section,'id')->hiddenInput()->label(false); ?>
    <?= $form->field($section,'user_id')->hiddenInput(['value'=>Yii::$app->user->identity->id])->label(false); ?>

    <div class="row">
        <div class="col">
            <?= $form->field($section, 'name' ,[
                'inputTemplate' => Yii::$app->params['inputTemplate'],
                'template' => '{label}{input}{error}{hint}',
                'labelOptions' => [
                    'class' => 'col control-label',
                ]
            ])
                ->textInput(['autofocus' => true ,'class' => 'input-field'])
                ->label('Название секции (кружка,клуба,лабораторий)');
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <?= $form->field($section, 'students_amount' ,[
                'inputTemplate' => Yii::$app->params['inputTemplate'],
                'template' => '{label}{input}{error}{hint}',
                'labelOptions' => [
                    'class' => 'col control-label',
                ]
            ])
                ->textInput(['autofocus' => true,'class' => 'input-field','type'=>'number'])
                ->label('Количество студентов');
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <?= $form->field($section, 'reporting_d_id' ,[
                'inputTemplate' => Yii::$app->params['inputTemplate'],
                'template' => '{label}{input}{error}{hint}',
                'labelOptions' => [
                    'class' => 'col control-label',
                ]
            ])
                ->dropDownList(Helper::comboList(new \app\models\ReportingD()),[])->label('Отчётная кафедра');?>
        </div>
    </div>

<?php ActiveForm::end(); ?>