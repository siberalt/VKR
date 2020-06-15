<?php
use yii\helpers\Html;
use \app\models\indicators\StatisticalIndicator;

$indicators = StatisticalIndicator::find()->where(['main'=>false,'category_s_id'=>$category_s->id])->all();
$sum = StatisticalIndicator::find()->where(['main'=>true,'category_s_id'=>$category_s->id])->one()->getNodesCount();
foreach ($indicators as $i=>$indicator) {
    $indicator = $indicator->getRow();
    $sum+=$indicator['amount'];
    $indicators[$i]=$indicator;
}
?>
<div class="row category-item">
    <div class="col-sm-1"></div>
    <div class="col">
        <div class="card">
        <input type="hidden" class="id" value="<?= $category_s->id ?>">
        <div class="card-header bg-info" id="headingOne">
            <div class="row justify-content-between">
                <div class="col">
                    <h2 class="mb-0 card-header-text">
                        <button class="btn btn-link btn-block text-left card-header-text" type="button" data-toggle="collapse" data-target="#collapse-sc<?=$category_s->id ?>" aria-expanded="true" aria-controls="collapseOne">
                            <?= $category_s->id.'. '.$category_s->name ?>
                        </button>
                    </h2>
                </div>
                <div class="col-auto">
                    <div class="row justify-content-end align-items-center button-more">
                        <button class="btn btn-primary option-button edit-category"
                                type="button">
                            <i class="glyphicon glyphicon-edit"></i>
                        </button>
                        <?= Html::Button('<i class="glyphicon glyphicon-plus "></i>',
                                [
                                    'class' => 'btn btn-success option-button add-indicator',
                                    'name' => 'back-button',
                                ]) ?>
                        <button class="btn btn-danger option-button delete-category"
                                type="button">
                            <i class="glyphicon glyphicon-remove"></i>
                        </button>
                        <input type="hidden" class="table-id" value="#table-sc-<?= $category_s->id ?>">
                        <input type="hidden" class="add" value="<?= \yii\helpers\Url::to(['s-indicator/create','id'=>$category_s->id]) ?>">
                        <input type="hidden" class="delete" value="<?= \yii\helpers\Url::to(['s-category/delete','id'=>$category_s->id]) ?>">
                        <input type="hidden" class="edit" value="<?= \yii\helpers\Url::to(['s-category/edit','id'=>$category_s->id]) ?>">
                        <input type="hidden" class="name" value="<?= $category_s->name ?>">
                    </div>
                </div>
            </div>
        </div>

        <div id="collapse-sc<?=$category_s->id ?>" class="collapse" aria-labelledby="headingOne" data-parent="#table-s-<?= $category_s->table_s_id?>">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">Наименование показателя</th>
                    <th scope="col">Код строки</th>
                    <th scope="col">Количество</th>
                    <th scope="col">Действия</th>
                </tr>
                </thead>
                <tbody id="table-sc-<?= $category_s->id?>">
                    <?php foreach ($indicators as $i=>$indicator): ?>
                        <?= $this->render('..\s-indicator\row',compact('indicator')) ?>
                    <?php endforeach;?>
                </tbody>

                <tbody>
                    <tr>
                        <th scope="row"> </th>
                        <td colspan="" align="right"> Общее количество: </td>
                        <td><?= $sum?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        </div>
    </div>
</div>

