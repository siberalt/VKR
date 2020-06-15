<?php


namespace app\controllers;

use app\models\indicators\CategoryF;
use app\models\indicators\FinalIndicator;
use app\models\NameForm;
use Yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;

class FCategoryController extends  Controller
{
    public function actionCreate()
    {
        $model = new NameForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $category_f = new CategoryF();
            $category_f->name = $model->name;
            $category_f->save();

            $indicators_f = [];
            return $this->renderAjax('row', compact('category_f','indicators_f'));
        }
    }

    public function actionDelete(){
        //return var_dump(CategoryF::findOne(Yii::$app->request->get('id')));
        CategoryF::findOne(Yii::$app->request->get('id'))->delete();
    }

    public function actionEdit(){
        $model = new NameForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $category_f = CategoryF::findOne(Yii::$app->request->get('id'));
            $category_f->name = $model->name;
            $category_f->save();
            return $this->renderAjax('row', compact('category_f'));
        }
    }
}