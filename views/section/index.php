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


<div class="card card-margin" id="specialties">
    <div class="card-header card-header-text bg-info">
        <div class="row ">
            <div class="col">
                Список секции
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Статус</th>
                <th scope="col">Название секции</th>
                <th scope="col">Руководитель</th>
                <th scope="col">Количество студентов</th>
                <th scope="col">Дата записи</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody id = "list-sections">
            <?php foreach ($sections as $i => $section):?>
                <?= $this->render('row',
                    [
                        'section'=>$section,
                        'actions'=>false
                    ]); ?>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>

