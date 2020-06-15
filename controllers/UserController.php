<?php


namespace app\controllers;

use app\models\Event;
use app\models\Student;
use app\models\Teacher;
use app\models\User;
use app\models\User_;
use app\models\UserType;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\helpers\ArrayHelper;

class UserController extends Controller
{
    public function actionCreate()
    {
        $user = new User();
        if(Yii::$app->request->isGet){
            return $this->render('create',compact('user'));
        }
        else if(Yii::$app->request->isPost){
            if($user->load(Yii::$app->request->post()) && $user->validate()){
                $user['password'] = Yii::$app->security->generatePasswordHash($user['password']);
                $user->save();
                //return var_dump(Yii::$app->request->post('User')['more']);
                //return var_dump(Url::previous());
                if(Yii::$app->request->post('User')['more']) return $this->redirect(['user/create']);
                else return $this->redirect(Url::previous());
            }
            else return $this->render('create',compact('user'));
        }
    }

    public function actionEdit(){
        $user = User::findOne(Yii::$app->request->get('id'));
        if(Yii::$app->request->isGet){
            $title = UserType::findOne($user['user_type_id'])['name'];
            $title = 'Редактирование пользователя "'.$title.'"';
            return $this->render('edit',compact('user','title'));
        }
        else if(Yii::$app->request->isPost){
            if($user->load(Yii::$app->request->post()) && $user->validate()){
                $user->save();
                return $this->redirect(Url::previous());
            }
        }
    }

    public function actionDelete(){
        if(Yii::$app->request->isGet){
            $id = Yii::$app->request->get('id');
            User::findOne($id)->delete();
        }
    }
}