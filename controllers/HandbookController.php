<?php


namespace app\controllers;

use app\models\NameForm;
use app\models\Student;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\web\Controller;
use yii\helpers\ArrayHelper;

class HandbookController extends  Controller
{
    public function actionCommon(){
        return $this->render('common');
    }

    public function actionUniversity(){
        return $this->render('university');
    }

    public function actionCreate()
    {
        $model = new NameForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            Yii::$app->db->createCommand()->insert(Yii::$app->request->get('table'), ['name' => $model->name])->execute();
            $id = Yii::$app->db->lastInsertID;
            $name = $model->name;
            return $this->renderAjax('row',
                [
                    'id'=>$id,
                    'name'=>$name,
                    'table' => Yii::$app->request->get('table'),
                    'actions' => Yii::$app->request->get('actions')
                ]);
        }
    }

    public function actionDelete(){
        Yii::$app->db->createCommand()->delete(Yii::$app->request->get('table'),'id = '.Yii::$app->request->get('id'))->execute();
    }

    public function actionEdit(){
        $model = new NameForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $table = Yii::$app->request->get('table');
            Yii::$app->db->createCommand()->update($table, ['name'=>$model->name], 'id = ' . Yii::$app->request->get('id'))->execute();
            return $this->renderAjax('row',
                [
                    'id'=>$model->id,
                    'name'=>$model->name,
                    'table'=>$table,
                    'actions' => Yii::$app->request->get('actions')
                ]);
        }
    }
}