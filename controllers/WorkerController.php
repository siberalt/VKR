<?php


namespace app\controllers;

use app\models\Event;
use app\models\Student;
use Yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;

class WorkerController extends Controller
{
    public function actionMain()
    {
        return $this->render('main');
    }
}