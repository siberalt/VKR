<?php


namespace app\models;


use yii\db\ActiveRecord;

class User_ extends  ActiveRecord
{
    public static function tableName(){
        return 'User';
    }

    public function rules()
    {
        return [
            [
                [
                    'degree_id',
                    'name',
                    'degree',
                    'position',
                    'user_type_id',
                    'rank_id',
                    'email',
                    'id'
                ],
                'safe'],
            [['login', 'password'], 'required', 'message' => 'Заполните поле'],
            ['login', 'unique', 'message' => 'Этот логин уже занят'],
        ];
    }
}