<?php


namespace app\models;


use yii\base\Model;
use yii\db\ActiveRecord;

class Student extends  ActiveRecord
{
    public function rules()
    {
        return [
            [['FIO'], 'required', 'message' => 'Это поле обязательно!'],
            [['Email','Password'],'required'],
            [['Record_number'],'safe'],
        ];
    }
}