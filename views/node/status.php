<?php
$type = ['time','remove','check'][$status_id-1];
$css_class = ['primary','danger','success'][$status_id-1];
?>
<div class="col alert alert-<?= $css_class?>" role="alert" id="status">
    Статус записи: <i class="glyphicon glyphicon-<?= $type?>"></i> <b><?= \app\models\Status::findOne($status_id)->name?></b>
</div>
