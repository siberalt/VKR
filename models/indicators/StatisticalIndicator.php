<?php


namespace app\models\indicators;


use yii\db\ActiveRecord;

class StatisticalIndicator extends  ActiveRecord
{
    public function rules(){
        return [
            [['table_s_id','category_s_id','name'],'safe']
        ];
    }

    public function getNodesCount(){
        $query = "SELECT COUNT(*) FROM `stat_rcd` WHERE `indicator_id` = ".$this->id;
        return \Yii::$app->db->createCommand($query)->queryScalar();
    }

    public function getRow(){
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'amount'=>$this->getNodesCount()
        ];
    }

    public function exist($node_id){
        $query = 'SELECT * FROM `stat_rcd` WHERE `node_id` = '.$node_id.' AND `indicator_id` = '.$this->id;
        return \Yii::$app->db->createCommand($query)->queryOne()!=null;
    }
}