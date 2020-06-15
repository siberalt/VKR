<?php


namespace app\controllers;

use app\models\indicators\CategoryS;
use app\models\indicators\FinalIndicator;
use app\models\indicators\TableS;
use app\models\NameForm;
use Yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;

class STableController extends  Controller
{
    public function actionCreate()
    {
        $model = new NameForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $table_s = new TableS();
            $table_s->name = $model->name;
            $table_s->save();

            $categories_s = [];
            return $this->renderAjax('row', compact('table_s','categories_s'));
        }
    }

    public function actionDelete(){
        //return var_dump(CategoryF::findOne(Yii::$app->request->get('id')));
        TableS::findOne(Yii::$app->request->get('id'))->delete();
    }

    public function actionEdit(){
        $model = new NameForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $table_s = TableS::findOne(Yii::$app->request->get('id'));
            $table_s->name = $model->name;
            $table_s->save();
            return $this->renderAjax('row', compact('table_s'));
        }
    }
}