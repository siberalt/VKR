<?php ?>

<tr>
    <th scope="row"><?= $indicator['id']?> </th>
    <td class="name"><?=$indicator['name']?></td>
    <td class="weight"><?=$indicator['weight']?></td>
    <td><?=$indicator['amount'] ?></td>
    <td><?=$indicator['total'] ?></td>
    <?php if(Yii::$app->user->identity->getRole()==\app\models\User::$ROLE_WORKER):?>
    <td>
        <a class="table-icon">
            <i class="glyphicon glyphicon-trash"></i>
            <input type="hidden" class="delete" value="<?= \yii\helpers\Url::to(['f-indicator/delete','id'=>$indicator['id']])?>">
        </a>
        <a class="table-icon">
            <i class="glyphicon glyphicon-pencil"></i>
            <input type="hidden" class="edit" value="<?= \yii\helpers\Url::to(['f-indicator/edit','id'=>$indicator['id']])?>">
        </a>
    </td>
    <?php endif;?>
</tr>
