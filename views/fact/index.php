<?php

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\NameForm;

$this->title = 'Участия в оргкомитетах';

?>

<div class="row">
    <div class="col">
        <h2><?= Html::encode($this->title) ?></h2>
    </div>
</div>

<div class="card card-margin" >
    <div class="card-header card-header-text bg-info">
        <div class="row ">
            <div class="col">
                Список фактов участия
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Статус</th>
                <th scope="col">Руководитель</th>
                <th scope="col">Название мероприятия</th>
                <th scope="col">Место проведения</th>
                <th scope="col">Дата записи</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody id = "list-sections">
            <?php foreach ($facts as $i => $fact):?>
                <?= $this->render('row',
                    [
                        'fact'=>$fact,
                        'actions'=>false
                    ]); ?>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>

<!--

                'teacher' => $teacher,
                'name' => $fact>name,
                'place' => $fact->place,
                'time' => $fact->time,
                'science_branch'=> $science_branch,
                'date' => $date
-->
