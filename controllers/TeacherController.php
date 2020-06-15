<?php


namespace app\controllers;

use app\models\node_types\Event;
use app\models\node_types\Fact;
use app\models\node_types\Section;
use app\models\node_types\Work;
use Yii;
use app\models\Teacher;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;
use app\models\Rank;
use app\models\Degree;

class TeacherController extends Controller
{
    public function actionCreate()
    {
        $teacher = new Teacher();
        if(Yii::$app->request->isGet) {
            $ranks = ArrayHelper::map(Rank::find()->all(), 'id', 'Name');
            $degrees = ArrayHelper::map(Degree::find()->all(), 'id', 'Name');
            return $this->render('create', ['teacher' => $teacher, 'ranks' => $ranks, 'degrees' => $degrees]);
        }
        else if(Yii::$app->request->isPost){

            if ($teacher->load(Yii::$app->request->post()) && $teacher->validate()) {
                $teacher->save();
                return $this->redirect(['site/users']);
            }
        }
    }

    public function actionEdit()
    {
        $teacher = new Teacher();
        if(Yii::$app->request->isGet) {
            $ranks = ArrayHelper::map(Rank::find()->all(), 'id', 'Name');
            $degrees = ArrayHelper::map(Degree::find()->all(), 'id', 'Name');
            return $this->render('edit', ['teacher' => $teacher, 'ranks' => $ranks, 'degrees' => $degrees]);
        }
        else if(Yii::$app->request->isPost){

            if ($teacher->load(Yii::$app->request->post()) && $teacher->validate()) {
                $teacher->save();
                return $this->redirect(['site/users']);
            }
        }
    }

    public function actionMain(){
        Url::remember();

        $sections = Section::getList(Yii::$app->user->identity->getId());
        $events = Event::getList(Yii::$app->user->identity->getId());
        $works = Work::getList(Yii::$app->user->identity->getId());
        $facts = Fact::getList(Yii::$app->user->identity->getId());
        return $this->render('main',compact(['sections','events','works','facts']));
    }



}