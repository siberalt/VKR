<?php

$glyphicon = ['glyphicon-time','glyphicon-remove','glyphicon-check'][$section['status_id']-1];
$css_class = ['table-primary','table-danger','table-success'][$section['status_id']-1];

use yii\helpers\Url; ?>
<tr>
    <th class="<?= $css_class?>" scope="row"> <i class="glyphicon   <?= $glyphicon?>"></i> <?= $section['status_name'] ?></th>
    <td class="<?= $css_class?>"><?= $section['name']?> </td>
    <td class="<?= $css_class?>"><?= $section['teacher']?></td>
    <td class="<?= $css_class?>"><?= $section['students_amount']?> </td>
    <td class="<?= $css_class?>"><?= $section['date']?></td>
    <td class="<?= $css_class?>">
    <?php if($actions):?>
        <input class="delete" type="hidden" value="<?= Url::to(['section/delete','id'=>$section['id']])?>" >
        <a class="table-icon"><i class="glyphicon glyphicon-trash"></i></a>
        <a class="table-icon" href="<?= Url::to(['section/edit','id'=>$section['id']])?>"><i class="glyphicon glyphicon-pencil"></i></a>
 <?php endif;?>
        <a class="table-icon" href="<?= Url::to(['section/show','id'=>$section['id']])?>"><i class="glyphicon glyphicon-eye-open"></i></a>
    </td>
</tr>
