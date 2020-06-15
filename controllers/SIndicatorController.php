<?php


namespace app\controllers;

use app\models\indicators\FinalIndicator;
use app\models\indicators\CategoryF;
use app\models\indicators\StatisticalIndicator;
use app\models\NameForm;
use Yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;

class SIndicatorController extends  Controller
{
    public function actionCreate()
    {
        $model = new NameForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $indicator = new StatisticalIndicator();
            $indicator->name = $model->name;
            $indicator->category_s_id = Yii::$app->request->get('id');
            $indicator->save();

            $indicator = $indicator->getRow();
            return $this->renderAjax('row', compact('indicator'));
        }
    }

    public function actionDelete(){
        //return var_dump(CategoryF::findOne(Yii::$app->request->get('id')));
        StatisticalIndicator::findOne(Yii::$app->request->get('id'))->delete();
    }

    public function actionEdit(){
        $indicator = StatisticalIndicator::findOne(Yii::$app->request->get('id'));
        if ($indicator->load(Yii::$app->request->post()) && $indicator->validate()) {
            $indicator->save();

            $indicator = $indicator->getRow();
            return $this->renderAjax('row', compact('indicator'));
        }
    }
}