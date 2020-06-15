<?php


namespace app\controllers;

use app\models\node_types\Fact;
use app\models\Student;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\helpers\ArrayHelper;

class FactController extends  Controller
{
    public function actionIndex(){
        $facts = Fact::getList(null);
        //return var_dump($sections);
        return $this->render('index',compact('facts'));
    }

    public function actionCreate()
    {
        $fact = new Fact();
        if(Yii::$app->request->isGet){
            return $this->render('create',compact('fact'));
        }
        else if(Yii::$app->request->isPost){
            if($fact->load(Yii::$app->request->post()) && $fact->validate()){
                $fact->save();
                if(Yii::$app->request->post('Fact')['more']) return $this->redirect(['fact/create']);
                else return $this->redirect(Url::previous());
            }
            else return $this->render('create',compact('fact'));
        }
    }

    public function actionEdit()
    {
        $fact = Fact::findOne(Yii::$app->request->get('id'));
        if(Yii::$app->request->isGet) {
            return $this->render('edit', compact('fact'));
        }
        else if(Yii::$app->request->isPost){

            if ($fact->load(Yii::$app->request->post()) && $fact->validate()) {
                $fact->save();
                return $this->redirect(Url::previous());
            }
            else return $this->render('edit',compact('fact'));
        }
    }

    public function actionShow(){
        $fact = Fact::findOne(Yii::$app->request->get('id'));
        $node = $fact->getNode();
        $fact = $fact->getShow();
        return $this->render('show',compact('fact','node'));
    }

    public function actionDelete(){
        if(Yii::$app->request->isGet){
            $id = Yii::$app->request->get('id');
            Fact::findOne($id)->delete();
        }
    }
}