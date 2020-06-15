<?php

$glyphicon = ['glyphicon-time','glyphicon-remove','glyphicon-check'][$fact['status_id']-1];
$css_class = ['table-primary','table-danger','table-success'][$fact['status_id']-1];

use yii\helpers\Url; ?>
<tr>
    <th class="<?= $css_class?>" scope="row"> <i class="glyphicon   <?= $glyphicon?>"></i> <?= $fact['status_name'] ?></th>
    <td class="<?= $css_class?>"><?= $fact['teacher']?></td>
    <td class="<?= $css_class?>"><?= $fact['name']?> </td>
    <td class="<?= $css_class?>"><?= $fact['place']?></td>

    <td class="<?= $css_class?>"><?= $fact['date']?></td>
    <?php if($actions):?>
        <input class="delete" type="hidden" value="<?= Url::to(['fact/delete','id'=>$fact['id']])?>" >
        <a class="table-icon"><i class="glyphicon glyphicon-trash"></i></a>
        <a class="table-icon" href="<?= Url::to(['fact/edit','id'=>$fact['id']])?>"><i class="glyphicon glyphicon-pencil"></i></a>
    <?php endif;?>
        <a class="table-icon" href="<?= Url::to(['fact/show','id'=>$fact['id']])?>"><i class="glyphicon glyphicon-eye-open"></i></a>
    </td>
</tr>
