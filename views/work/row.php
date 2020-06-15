<?php
use  \yii\helpers\Url;
$glyphicon = ['glyphicon-time','glyphicon-remove','glyphicon-check'][$work['status_id']-1];
$css_class = ['table-primary','table-danger','table-success'][$work['status_id']-1];
?>
<tr>
    <th class="<?= $css_class?>" scope="row"> <i class="glyphicon   <?= $glyphicon?>"></i> <?= $work['status_name'] ?></th>
    <td class="<?= $css_class?>"><?= $work['teacher']?></td>
    <td class="<?= $css_class?>"><?= $work['name']?> </td>
    <td class="<?= $css_class?>"><?= $work['students_names']?></td>
    <td class="<?= $css_class?>"><?= $work['date']?></td>
    <td class="<?= $css_class?>">
    <?php if($actions):?>
        <input class="delete" type="hidden" value="<?= Url::to(['work/delete','id'=>$work['id']])?>" >
        <a class="table-icon"><i class="glyphicon glyphicon-trash"></i></a>
        <a class="table-icon" href="<?= Url::to(['work/edit','id'=>$work['id']])?>"><i class="glyphicon glyphicon-pencil"></i></a>
    <?php endif;?>
        <a class="table-icon" href="<?= Url::to(['work/show','id'=>$work['id']])?>"><i class="glyphicon glyphicon-eye-open"></i></a>
    </td>
</tr>
<!--
            $list[$i] = [
                'teacher' => $teacher,
                'name' => $work->name,
                'students_names' => $work->students_names,
                'science_branch'=> $science_branch,
                'date' => $date
            ];
-->
