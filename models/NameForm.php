<?php


namespace app\models;


use yii\base\Model;

class NameForm extends Model
{
    public $id;
    public $name;

    public function rules()
    {
        return [
            ['name','required'],
            ['id','safe']
        ];
    }
}