<?php


namespace app\controllers;

use app\models\Student;
use Yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;

class StudentController extends  Controller
{
    public function actionCreate()
    {
        $student = new Student();
        if(Yii::$app->request->isGet) {
            return $this->render('create', compact('student'));
        }
        else if(Yii::$app->request->isPost){
            if ($student->load(Yii::$app->request->post()) && $student->validate()) {
                $student->save();
                return $this->redirect(['site/users']);
            }
        }
    }

    public function actionDelete(){
        if(Yii::$app->request->isGet){
            $id = Yii::$app->request->get('id');
            Student::findOne($id)->delete();
        }
    }

    public function actionEdit()
    {
        $student = new Student();
        if(Yii::$app->request->isGet) {
            return $this->render('edit', compact('student'));
        }
        else if(Yii::$app->request->isPost){
            if ($student->load(Yii::$app->request->post()) && $student->validate()) {
                $student->save();
                return $this->redirect(['site/users']);
            }
        }
    }
}