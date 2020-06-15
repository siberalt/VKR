<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    static public $ROLE_TEACHER = 1;
    static public $ROLE_ADMIN = 2;
    static public $ROLE_WORKER= 3;

    //\yii\base\BaseObject
    //public $id;
    //public $username;
    //public $password;
    //public $authKey;
   // public $accessToken;
    public function rules()
    {
        //$fill_field = Yii::$app->params['alert']('Заполните поле');
        //$login = Yii::$app->params['alert']('Этот логин уже занят');
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

    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        $user = User::findOne($id);
        if($user!=null)return $user;
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    private $url = '';
    public function setMainPage($url){
        $this->url = $url;
    }

    public function getMainPage(){
        return $this->url;
    }

    public function getRole(){
        return $this->user_type_id;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $user = User::findOne(['login' => $username]);
        if($user!=null)return $user;

        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->id;
        //return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->password);
        //return $this->password === $password;
    }
}
