<?php

$glyphicon = ['glyphicon-time','glyphicon-remove','glyphicon-check'][$event['status_id']-1];
$css_class = ['table-primary','table-danger','table-success'][$event['status_id']-1];

use yii\helpers\Url; ?>
<tr>
    <th class="<?= $css_class?>" scope="row"> <i class="glyphicon   <?= $glyphicon?>"></i> <?= $event['status_name'] ?></th>
    <td class="<?= $css_class?>"><?= $event['teacher']?></td>
    <td class="<?= $css_class?>"><?= $event['name']?> </td>
    <td class="<?= $css_class?>"><?= $event['students_names']?></td>
    <td class="<?= $css_class?>"><?= $event['date']?></td>
    <td class="<?= $css_class?>">
    <?php if($actions):?>
        <input class="delete" type="hidden" value="<?= Url::to(['event/delete','id'=>$event['id']])?>" >
        <a class="table-icon"><i class="glyphicon glyphicon-trash"></i></a>
        <a class="table-icon"  href="<?= Url::to(['event/edit','id'=>$event['id']])?>"><i class="glyphicon glyphicon-pencil"></i></a>
    <?php endif;?>
        <a class="table-icon" href="<?= Url::to(['event/show','id'=>$event['id']])?>"><i class="glyphicon glyphicon-eye-open"></i></a>
    </td>
</tr>
<!--
            [
                'teacher' => $teacher,
                'name' => $event>name,
                'place' => $event->place,
                'time' => $event->time,
                'science_branch'=> $science_branch,
                'students_names'=> $event->students_names,
                'date' => $date
            ];
-->
