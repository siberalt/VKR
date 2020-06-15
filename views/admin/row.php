<?php use yii\helpers\Url;

if(($degree = \app\models\Degree::find()->where(['id' => $user['degree_id']])->one())!=null){
    $degree = $degree['name'];
}

if(($rank = \app\models\Rank::find()->where(['id' => $user['rank_id']])->one())!=null){
    $rank = $rank['name'];
}
?>
<div class="row container list-item">
    <div class="row container">
        <div class="col-sm-4">
            <div class="company-image">
                <img src="empty.png" width="100%" height="100%" alt="lorem">
            </div>
        </div>
        <div class="col ">
            <div class="row justify-content-end align-items-center button-more">
                <button class="btn btn-info option-button show"
                        type="button"
                        onClick='location.href=<?= '"'.Url::to(['user/show','id'=>$user['id']],true).'"';?>'>
                    <i class="glyphicon glyphicon-info-sign"></i>
                </button>
                <button class="btn btn-primary option-button edit"
                        type="button"
                        onClick='location.href=<?= '"'.Url::to(['user/edit','id'=>$user['id']],true).'"';?>'>
                    <i class="glyphicon glyphicon-edit"></i>
                </button>
                <button class="btn btn-danger option-button delete"
                        type="button">
                    <i class="glyphicon glyphicon-remove"></i>
                </button>
                <input class="url" name="id" type="hidden" value="<?= Url::to(['user/delete','id'=>$user['id']],true)?>">
            </div>
            <div class="row"> <span class="attribute">Ф.И.О: </span><pre class="text"> <?= $user['name'] ?> </pre></div>
            <div class="row"> <span class="attribute">Должность: </span> <pre class="text"> <?= $user['position'] ?></pre></div>
            <div class="row"> <span class="attribute">Почта: </span> <pre class="text"> <?= $user['email'] ?> </pre></div>
        </div>
    </div>
</div>

