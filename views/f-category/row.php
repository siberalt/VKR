<?php use yii\helpers\Html;
?>

<div class="card">
    <input type="hidden" class="id" value="<?= $category_f->id ?>">
    <div class="card-header bg-info" id="headingOne">
        <div class="row justify-content-between">
            <div class="col">
                <h2 class="mb-0 card-header-text">
                    <button class="btn btn-link btn-block text-left card-header-text" type="button" data-toggle="collapse" data-target="#collapse-<?=$category_f->id ?>" aria-expanded="true" aria-controls="collapseOne">
                        <?= $category_f->id.'. '.$category_f->name ?>
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
                    <input type="hidden" class="table-id" value="#table-<?= $category_f->id ?>">
                    <input type="hidden" class="add" value="<?= \yii\helpers\Url::to(['f-indicator/create','id'=>$category_f->id]) ?>">
                    <input type="hidden" class="delete" value="<?= \yii\helpers\Url::to(['f-category/delete','id'=>$category_f->id]) ?>">
                    <input type="hidden" class="edit" value="<?= \yii\helpers\Url::to(['f-category/edit','id'=>$category_f->id]) ?>">
                    <input type="hidden" class="name" value="<?= $category_f->name ?>">
                </div>
            </div>
        </div>
    </div>

    <div id="collapse-<?=$category_f->id ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionFinal">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">№ п\п</th>
                <th scope="col">Наименование показателя</th>
                <th scope="col">Весовой коэффициент показателя</th>
                <th scope="col">Количество</th>
                <th scope="col">Итого</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody id="table-<?= $category_f->id?>">
                <?php foreach ($indicators_f as $i=>$indicator): ?>
                    <?= $this->render('..\f-indicator\row',compact('indicator')) ?>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
