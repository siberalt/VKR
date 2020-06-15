<?php


namespace app\controllers;

use app\models\Event;
use app\models\node_types\Node;
use app\models\Student;
use Yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;

class NodeController extends  Controller
{
    public function actionStatus()
    {
        $node = Node::findOne(Yii::$app->request->get('id'));
        $node->status_id = Yii::$app->request->get('status');
        $node->save();
        return $this->renderAjax('status',['status_id'=>$node->status_id]);
    }

    public function actionBindf(){
        $node_id = Yii::$app->request->get('node_id');
        $ind_id = Yii::$app->request->get('ind_id');
        if(Yii::$app->request->post('check')=="true"){
            $query = 'INSERT INTO `fin_rcd`(`indicator_id`, `node_id`) VALUES ('.$ind_id.', '.$node_id.')';
        }else{
            $query = 'DELETE FROM `fin_rcd` WHERE `indicator_id`= '.$ind_id.' and `node_id` = '.$node_id;
        }
        Yii::$app->db->createCommand($query)->execute();
    }

    public function actionBinds(){
        $node_id = Yii::$app->request->get('node_id');
        $ind_id = Yii::$app->request->get('ind_id');
        if(Yii::$app->request->post('check')=="true"){
            $query = 'INSERT INTO `stat_rcd`(`indicator_id`, `node_id`) VALUES ('.$ind_id.', '.$node_id.')';
        }else{
            $query = 'DELETE FROM `stat_rcd` WHERE `indicator_id`= '.$ind_id.' and `node_id` = '.$node_id;
        }
        Yii::$app->db->createCommand($query)->execute();
    }
}