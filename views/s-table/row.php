<?php
use yii\helpers\Html;
use \app\models\indicators\StatisticalIndicator;

$categories_s = \app\models\indicators\CategoryS::find()->where(['table_s_id'=>$table_s->id])->all();

?>
<div class="card">
    <div class="card-header bg-info" id="heading1">
        <div class="row justify-content-between">
            <div class="col">
                <h2 class="mb-0 card-header-text">
                    <button class="btn btn-link btn-block text-left card-header-text" type="button" data-toggle="collapse" data-target="#collapse-s-<?= $table_s->id?>" aria-expanded="true" aria-controls="collapse1">
                        <?= $table_s->id.'. '. $table_s->name?>
                    </button>
                </h2>
            </div>
            <div class="col-auto">
                <div class="row justify-content-end align-items-center button-more">
                    <button class="btn btn-primary option-button edit-table"
                            type="button">
                        <i class="glyphicon glyphicon-edit"></i>
                    </button>
                    <?= Html::Button('<i class="glyphicon glyphicon-plus"></i>',
                        ['class' => 'btn btn-success option-button add-category',
                            'name' => 'back-button',
                            ]) ?>
                    <button class="btn btn-danger option-button delete-table"
                            type="button">
                        <i class="glyphicon glyphicon-remove"></i>
                    </button>
                    <input type="hidden" class="table-id" value="#table-s-<?= $table_s->id ?>">
                    <input type="hidden" class="add" value="<?= \yii\helpers\Url::to(['s-category/create','id'=>$table_s->id]) ?>">
                    <input type="hidden" class="delete" value="<?= \yii\helpers\Url::to(['s-table/delete','id'=>$table_s->id]) ?>">
                    <input type="hidden" class="edit" value="<?= \yii\helpers\Url::to(['s-table/edit','id'=>$table_s->id]) ?>">
                    <input type="hidden" class="name" value="<?= $table_s->name ?>">
                </div>
            </div>
        </div>
    </div>

    <div id="collapse-s-<?= $table_s->id?>" class="collapse" aria-labelledby="heading1" data-parent="#accordionStat">
            <div class="accordion col" id="table-s-<?= $table_s->id?>">
                <?php foreach ($categories_s as $i=>$category_s):?>
                    <?= $this->render('..\s-category\row',compact('category_s'));?>
                <?php endforeach;?>
            </div>
    </div>
</div>

<!---->
