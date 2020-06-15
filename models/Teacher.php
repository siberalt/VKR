<?php


namespace app\models;


use yii\base\Model;
use yii\db\ActiveRecord;

class Teacher extends ActiveRecord
{
    public function rules()
    {
        return [
            [['FIO'], 'required', 'message' => 'Это поле обязательно!'],
            [['Email','Password'],'required'],
            [['Rank_id','Degree_id','Position'],'safe'],
        ];
    }
}