<?php
namespace app;

use yii\helpers\ArrayHelper;

class Helper
{
    public static function getName($activeRecord,$id){
        $name = $activeRecord::findOne($id);
        return isset($name)? $name->name: 'Не указано';
    }

    public static function comboList($activeRecord){
        return [null=>'Не указано'] + ArrayHelper::map($activeRecord::find()->all(), 'id', 'name');
    }
}