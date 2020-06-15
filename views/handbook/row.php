<?php ?>
<tr>
    <th class="id" scope="row"> <?= $id ?></th>
    <td class="name"><?= $name?> </td>
    <?php if($actions):?>
    <td>
        <a class="table-icon"><i class="glyphicon glyphicon-trash"></i></a>
        <a class="table-icon"><i class="glyphicon glyphicon-pencil"></i></a>
        <input class="delete" name="url" type="hidden" value="<?= \yii\helpers\Url::to(['handbook/delete','id'=>$id,'table'=>$table]);?>">
        <input class="edit" name="url" type="hidden" value="<?= \yii\helpers\Url::to(['handbook/edit','id'=>$id,'table'=>$table,'actions'=>$actions]);?>">
    </td>
    <?php endif;?>
</tr>
