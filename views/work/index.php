<?php

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\NameForm;

$this->title = 'Научные секции';

?>

<div class="row">
    <div class="col">
        <h2><?= Html::encode($this->title) ?></h2>
    </div>
</div>

<!--
            $list[$i] = [
                'teacher' => $teacher,
                'name' => $work->name,
                'students_names' => $work->students_names,
                'science_branch'=> $science_branch,
                'date' => $date
            ];
-->
<div class="card card-margin" id="specialties">
    <div class="card-header card-header-text bg-info">
        <div class="row ">
            <div class="col">
                Список научных работ
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Статус</th>
                <th scope="col">Руководитель</th>
                <th scope="col">Название работы</th>
                <th scope="col">ФИО студентов</th>
                <th scope="col">Дата записи</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody id = "list-sections">
            <?php foreach ($works as $i => $work):?>
                <?= $this->render('row',
                    [
                        'work'=>$work,
                        'actions'=>false
                    ]); ?>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>

