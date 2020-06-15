<?php


namespace app\models\indicators;


use yii\db\ActiveRecord;

class FinalIndicator extends  ActiveRecord
{
    public function rules(){
        return [
            [['category_f_id','weight','name'],'safe']
        ];
    }

    public function getNodesCount(){
        $query = "SELECT COUNT(*) FROM `fin_rcd` WHERE `indicator_id` = ".$this->id;
        return \Yii::$app->db->createCommand($query)->queryScalar();
    }

    public function getRow(){
        $count = $this->getNodesCount();
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'weight'=>$this->weight,
            'amount'=>$count,
            'total'=>$count*$this->weight
        ];
    }

    public function exist($node_id){
        $query = 'SELECT * FROM `fin_rcd` WHERE `node_id` = '.$node_id.' AND `indicator_id` = '.$this->id;
        return \Yii::$app->db->createCommand($query)->queryOne()!=null;
    }

}