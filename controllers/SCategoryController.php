<?php


namespace app\controllers;

use app\models\indicators\CategoryS;
use app\models\indicators\FinalIndicator;
use app\models\NameForm;
use Yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;

class SCategoryController extends  Controller
{
    public function actionCreate()
    {
        $model = new NameForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $category_s = new CategoryS();
            $category_s->name = $model->name;
            $category_s->table_s_id = Yii::$app->request->get('id');
            $category_s->save();

            $indicators_s = [];
            return $this->renderAjax('row', compact('category_s','indicators_s'));
        }
    }

    public function actionDelete(){
        //return var_dump(CategoryF::findOne(Yii::$app->request->get('id')));
        CategoryS::findOne(Yii::$app->request->get('id'))->delete();
    }

    public function actionEdit(){
        $model = new NameForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $category_s = CategoryS::findOne(Yii::$app->request->get('id'));
            $category_s->name = $model->name;
            $category_s->save();
            return $this->renderAjax('row', compact('category_s'));
        }
    }
}