<?php


namespace app\models\node_types;


use app\Helper;
use app\models\EventLevel;
use app\models\EventType;
use app\models\JuryStatus;
use app\models\ReportingD;
use app\models\ScienceBranch;
use app\models\Specialty;
use app\models\Status;
use app\models\User;
use yii\db\ActiveRecord;

class Fact extends  ActiveRecord
{
    public function rules()
    {
        return [
            [
                [
                    'id',
                    'user_id',
                    'reporting_d_id',
                    'science_branch_id',
                    'specialty_id'
                ],
                'safe'
            ],
            [
                [
                    'name',
                    'place',
                    'time',
                    'event_level_id',
                    'event_type_id',
                    'jury_status_id'
                ],
                'required', 'message' => 'Заполните поле'
            ],
        ];
    }

    public static function getList($id)
    {
        $list = [];

        if ($id == null) {
            $facts = Fact::find()->all();
        }
        else {
            $facts = Fact::find()->where(['user_id'=> $id])->all();
        }
        $list = [];
        foreach ($facts as $i => $fact) {
            $status_id = \Yii::$app->db->createCommand('SELECT get_fact_status(' . $fact->id . ', ' . $fact->user_id . ')')->queryScalar();
            $date = \Yii::$app->db->createCommand('SELECT get_fact_date(' . $fact->id . ', ' . $fact->user_id . ')')->queryScalar();
            $status_name = Status::findOne($status_id)->name;
            $teacher = User::findOne($fact->user_id);
            $teacher = isset($teacher) ? $teacher->name : null;
            $science_branch = ScienceBranch::findOne($fact->science_branch_id);
            $science_branch = isset($science_branch) ? $science_branch->name : null;
            $list[$i] = [
                'status_id' => $status_id,
                'status_name' => $status_name,
                'id' => $fact->id,
                'teacher' => $teacher,
                'name' => $fact>name,
                'place' => $fact->place,
                'time' => $fact->time,
                'science_branch'=> $science_branch,
                'date' => $date
            ];
        }
        return $list;
    }

    public function getNode(){
        $id = \Yii::$app->db->createCommand('SELECT `node_id` FROM `fact_node` WHERE `id` = '.$this->id)->queryScalar();
        return Node::findOne($id);
    }

    public function getShow(){
        return [
            'id'=>$this->id,
            'name'=> $this->name,
            'place'=>$this->place,
            'time'=>$this->time,
            'event_type'=>Helper::getName( new EventType(),$this->event_type_id),
            'event_level'=>Helper::getName( new EventLevel(),$this->event_level_id),
            'teacher'=>Helper::getName(new User(),$this->teacher_id),
            'science_branch'=>Helper::getName(new ScienceBranch(),$this->science_branch_id),
            'specialty'=>Helper::getName(new Specialty(),$this->specialty_id),
            'reporting_d'=>Helper::getName(new ReportingD(),$this->reporting_d_id),
            'jury_status_id'=>Helper::getName(new JuryStatus(),$this->jury_status_id)
        ];
    }
}