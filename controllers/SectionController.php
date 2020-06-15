<?php


namespace app\controllers;

use app\models\node_types\Event;
use app\models\node_types\Section;
use app\models\node_types\Work;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\helpers\ArrayHelper;

class SectionController extends Controller
{
    public function actionIndex(){
        $sections = Section::getList(null);
        //return var_dump($sections);
        return $this->render('index',compact('sections'));
    }

    public function actionCreate()
    {
        $section = new Section();
        if(Yii::$app->request->isGet){
            return $this->render('create', compact('section'));
        }
        else if(Yii::$app->request->isPost){
            if($section->load(Yii::$app->request->post()) && $section->validate()){
                $section->save();
                if(Yii::$app->request->post('Section')['more']) return $this->redirect(['section/create']);
                else return $this->redirect(Url::previous());
            }
            else return $this->render('create',compact('section'));
        }
    }

    public function actionEdit()
    {
        $section = Section::findOne(Yii::$app->request->get('id'));
        if(Yii::$app->request->isGet) {
            return $this->render('edit', compact('section'));
        }
        else if(Yii::$app->request->isPost){

            if ($section->load(Yii::$app->request->post()) && $section->validate()) {
                $section->save();
                return $this->redirect(Url::previous());
            }
            else return $this->render('edit',compact('section'));
        }
    }

    public function actionShow(){
        $section = Section::findOne(Yii::$app->request->get('id'));
        $node = $section->getNode();
        $section = $section->getShow();
        return $this->render('show',compact('section','node'));
    }

    public function actionDelete(){
        if(Yii::$app->request->isGet){
            $id = Yii::$app->request->get('id');
            Section::findOne($id)->delete();
        }
    }
}