<?php ?>

<tr>
    <th class="name" scope="row"><?= $indicator['name']?> </th>
    <td class="id"><?=$indicator['id']?></td>
    <td ><?= $indicator['amount'] ?></td>
    <?php if(Yii::$app->user->identity->getRole()==\app\models\User::$ROLE_WORKER):?>
    <td>
        <a class="table-icon">
            <i class="glyphicon glyphicon-trash"></i>
            <input type="hidden" class="delete" value="<?= \yii\helpers\Url::to(['s-indicator/delete','id'=>$indicator['id']])?>">
        </a>
        <a class="table-icon">
            <i class="glyphicon glyphicon-pencil"></i>
            <input type="hidden" class="edit" value="<?= \yii\helpers\Url::to(['s-indicator/edit','id'=>$indicator['id']])?>">
        </a>
    </td>
    <?php endif;?>
</tr>
