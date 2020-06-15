<?php


namespace app\controllers;

use app\models\node_types\Event;
use app\models\Section;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\helpers\ArrayHelper;

class EventController extends  Controller
{
    public function actionIndex(){
        $events = Event::getList(null);
        //return var_dump($sections);
        return $this->render('index',compact('events'));
    }

    public function actionCreate()
    {
        $event = new Event();
        if(Yii::$app->request->isGet){
            return $this->render('create',compact('event'));
        }
        else if(Yii::$app->request->isPost){
            if($event->load(Yii::$app->request->post()) && $event->validate()){
                $event->save();
                if(Yii::$app->request->post('Event')['more']) return $this->redirect(['event/create']);
                else return $this->redirect(Url::previous());
            }
            else return $this->render('create',compact('event'));
        }
    }

    public function actionEdit()
    {
        $event = Event::findOne(Yii::$app->request->get('id'));
        if(Yii::$app->request->isGet) {
            return $this->render('edit', compact('event'));
        }
        else if(Yii::$app->request->isPost){

            if ($event->load(Yii::$app->request->post()) && $event->validate()) {
                $event->save();
                return $this->redirect(Url::previous());
            }
            else return $this->render('edit',compact('event'));
        }
    }

    public function actionShow(){
        $event = Event::findOne(Yii::$app->request->get('id'));
        $node = $event->getNode();
        $event = $event->getShow();
        return $this->render('show',compact('event','node'));
    }

    public function actionDelete(){
        if(Yii::$app->request->isGet){
            $id = Yii::$app->request->get('id');
            Event::findOne($id)->delete();
        }
    }
}