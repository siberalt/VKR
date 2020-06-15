<?php

namespace app\controllers;

use app\models\node_types\Work;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;

class WorkController extends Controller
{
    public function actionIndex(){
        $works = Work::getList(null);
        //return var_dump($sections);
        return $this->render('index',compact('works'));
    }

    public function actionCreate()
    {
        $work = new Work();
        if(Yii::$app->request->isGet){
            return $this->render('create', compact('work'));
        }
        else if(Yii::$app->request->isPost){
            if($work->load(Yii::$app->request->post()) && $work->validate()){
                $work->save();
                //return var_dump(Yii::$app->request->post('more'));
                if(Yii::$app->request->post('Work')['more']) return $this->redirect(['work/create']);
                else return $this->redirect(Url::previous());
            }
            else return $this->render('create',compact('work'));
        }
    }

    public function actionEdit()
    {
        $work = Work::findOne(Yii::$app->request->get('id'));
        if(Yii::$app->request->isGet) {
            return $this->render('edit', compact('work'));
        }
        else if(Yii::$app->request->isPost){

            if ($work->load(Yii::$app->request->post()) && $work->validate()) {
                $work->save();
                return $this->redirect(Url::previous());
            }
            else return $this->render('edit',compact('work'));
        }
    }

    public function actionShow(){
        $work = Work::findOne(Yii::$app->request->get('id'));
        $node = $work->getNode();
        $work = $work->getShow();
        return $this->render('show',compact('work','node'));
    }

    public function actionDelete(){
        if(Yii::$app->request->isGet){
            $id = Yii::$app->request->get('id');
            Work::findOne($id)->delete();
        }
    }




}