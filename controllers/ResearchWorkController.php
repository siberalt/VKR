<?php

namespace app\controllers;

use app\models\ResearchWork;
use app\models\Student;
use app\models\Task;
use Yii;
use yii\web\Controller;

class ResearchWorkController extends Controller
{
    public function actionCreate()
    {
        $work = new Student();
        if(Yii::$app->request->isGet) {
            return $this->render('create', compact('work'));
        }
        else if(Yii::$app->request->isPost){
            if ($work->load(Yii::$app->request->post()) && $work->validate()) {
                $work->save();
                return $this->redirect(['research-work/show','id'=>$work['id']]);
            }
        }
    }

    public function actionShow(){
        if(Yii::$app->request->isGet){
            $id = Yii::$app->request->get('id');
            $work = ResearchWork::findOne($id);
            $tasks = Task::find()->where(['Research_work_id'=>$id])->all();
            return $this->render('show',compact('work','tasks'));
        }
    }
}