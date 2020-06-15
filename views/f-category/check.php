<?php use yii\helpers\Html;
$enabled = Yii::$app->user->identity->getRole()==\app\models\User::$ROLE_WORKER ? '':'disabled';

$indicators_f = \app\models\indicators\FinalIndicator::find()->where(['category_f_id'=>$category_f->id])->all();
foreach ($indicators_f as $i => $item){
    $checked = $item->exist($node_id)?'checked':'';
    $indicators_f[$i] =
        [
            'id'=> $item['id'],
            'enabled'=>$enabled,
            'checked'=>$checked,
            'name'=>$item->name
        ];
}
?>

<div class="card">
    <div class="card-header bg-info" id="headingOne">
        <div class="row justify-content-between">
            <div class="col">
                <h2 class="mb-0 card-header-text">
                    <button class="btn btn-link btn-block text-left card-header-text" type="button" data-toggle="collapse" data-target="#collapse-<?=$category_f->id ?>" aria-expanded="true" aria-controls="collapseOne">
                        <?= $category_f->id.'. '.$category_f->name ?>
                    </button>
                </h2>
            </div>
        </div>
    </div>

    <div id="collapse-<?=$category_f->id ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionFinal">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">№ п\п</th>
                <th scope="col">Выбрать</th>
                <th scope="col">Наименование показателя</th>
            </tr>
            </thead>
            <tbody id="table-<?= $category_f->id?>">
                <?php foreach ($indicators_f as $i=>$indicator): ?>
                    <?= $this->render('..\f-indicator\check',compact(['indicator','node_id'])) ?>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
