<?php ?>

<tr>
    <th scope="row"><?= $indicator['id']?> </th>
    <td>
        <input class="check" type="checkbox" <?= $indicator['checked']?> <?= $indicator['enabled']?>>
        <input class="url" type="hidden"
               value="<?= \yii\helpers\Url::to(
                       [
                           'node/binds',
                           'node_id'=>$node_id,
                           'ind_id'=>$indicator['id']
                       ])?>">
    </td>
    <td ><?=$indicator['name']?></td>
</tr>
