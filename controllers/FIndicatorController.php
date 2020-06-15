<?php


namespace app\controllers;

use app\models\indicators\FinalIndicator;
use app\models\indicators\CategoryF;
use app\models\NameForm;
use Yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;

class FIndicatorController extends  Controller
{
    public function actionCreate()
    {
        $indicator = new FinalIndicator();
        if ($indicator->load(Yii::$app->request->post()) && $indicator->validate()) {
            $indicator->category_f_id = Yii::$app->request->get('id');
            $indicator->save();

            $indicator = $indicator->getRow();
            return $this->renderAjax('row', compact('indicator'));
        }
    }

    public function actionDelete(){
        //return var_dump(CategoryF::findOne(Yii::$app->request->get('id')));
        FinalIndicator::findOne(Yii::$app->request->get('id'))->delete();
    }

    public function actionEdit(){
        $indicator = FinalIndicator::findOne(Yii::$app->request->get('id'));
        if ($indicator->load(Yii::$app->request->post()) && $indicator->validate()) {
            $indicator->save();

            $indicator = $indicator->getRow();
            return $this->renderAjax('row', compact('indicator'));
        }
    }
}