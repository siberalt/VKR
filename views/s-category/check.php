<?php
use yii\helpers\Html;
use \app\models\indicators\StatisticalIndicator;
$enabled = Yii::$app->user->identity->getRole()==\app\models\User::$ROLE_WORKER ? '':'disabled';

$indicators = StatisticalIndicator::find()->where(['category_s_id'=>$category_s->id])->all();
$list=[];
foreach ($indicators as $i => $item){
    $checked = $item->exist($node_id)?'checked':'';
    $var = [
        'id'=> $item['id'],
        'enabled'=>$enabled,
        'checked'=>$checked,
        'name'=>$item->name
    ];

    if($item->main) $main = $var;
    else $list[$i] = $var;
}
$indicators = $list;
?>
<div class="row category-item">
    <div class="col-sm-1"></div>
    <div class="col">
        <div class="card">
        <input type="hidden" class="id" value="<?= $category_s->id ?>">
        <div class="card-header bg-info" id="headingOne">
            <div class="row justify-content-between">
                <div class="col-1">
                    <input class="check" type="checkbox" <?= $main['checked']?> <?= $main['enabled']?>>
                    <input class="url" type="hidden"
                           value="<?= \yii\helpers\Url::to(
                               [
                                   'node/binds',
                                   'node_id'=>$node_id,
                                   'ind_id'=>$main['id']
                               ])?>">
                </div>
                <div class="col">
                    <h2 class="mb-0 card-header-text">
                        <button class="btn btn-link btn-block text-left card-header-text" type="button" data-toggle="collapse" data-target="#collapse-sc<?=$category_s->id ?>" aria-expanded="true" aria-controls="collapseOne">
                            <?= $category_s->id.'. '.$category_s->name ?>
                        </button>
                    </h2>
                </div>
            </div>
        </div>

        <div id="collapse-sc<?=$category_s->id ?>" class="collapse" aria-labelledby="headingOne" data-parent="#table-s-<?= $category_s->table_s_id?>">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">Код строки</th>
                    <th scope="col">Выбрать</th>
                    <th scope="col">Наименование показателя</th>
                </tr>
                </thead>
                <tbody id="table-sc-<?= $category_s->id?>">
                    <?php foreach ($indicators as $i=>$indicator): ?>
                        <?= $this->render('..\s-indicator\check',compact(['indicator','node_id'])) ?>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>

