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
        </div>
    </div>

    <div id="collapse-s-<?= $table_s->id?>" class="collapse" aria-labelledby="heading1" data-parent="#accordionStat">
            <div class="accordion col" id="table-s-<?= $table_s->id?>">
                <?php foreach ($categories_s as $i=>$category_s):?>
                    <?= $this->render('..\s-category\check',compact(['category_s','node_id']));?>
                <?php endforeach;?>
            </div>
    </div>
</div>

<!---->
