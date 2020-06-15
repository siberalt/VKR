<?php

namespace app\models\node_types;

use app\Helper;
use app\models\EventLevel;
use app\models\EventType;
use app\models\ReportingD;
use app\models\ScienceBranch;
use app\models\Specialty;
use app\models\Status;
use app\models\User;
use yii\db\ActiveRecord;

class Event extends  ActiveRecord
{
    public function rules()
    {
        return [
            [
                [
                    'reporting_d_id',
                    'teacher_id',
                    'result_id'
                ],
                'safe'
            ],
            [
                [
                    'name',
                    'students_names',
                    'event_type_id',
                    'event_level_id',
                    'number_group',
                    'science_branch_id',
                    'specialty_id'
                ],
                'required', 'message' => 'Заполните поле'
            ],
        ];
    }

    public static function getList($id)
    {
        $list = [];

        if ($id == null) {
            $events = Event::find()->all();
        }
        else {
            $events = Event::find()->where(['teacher_id'=> $id])->all();
        }
        $list = [];
        foreach ($events as $i => $event) {
            $status_id = \Yii::$app->db->createCommand('SELECT get_event_status(' . $event->id . ', ' . $event->teacher_id . ')')->queryScalar();
            $date = \Yii::$app->db->createCommand('SELECT get_event_date(' . $event->id . ', ' . $event->teacher_id . ')')->queryScalar();
            $status_name = Status::findOne($status_id)->name;
            $teacher = User::findOne($event->teacher_id);
            $teacher = isset($teacher) ? $teacher->name : null;
            $science_branch = ScienceBranch::findOne($event->science_branch_id);
            $science_branch = isset($science_branch) ? $science_branch->name : null;
            $list[$i] = [
                'status_id' => $status_id,
                'status_name' => $status_name,
                'id' => $event->id,
                'teacher' => $teacher,
                'name' => $event->name,
                'place' => $event->place,
                'time' => $event->time,
                'science_branch'=> $science_branch,
                'students_names'=> $event->students_names,
                'date' => $date
            ];
        }
        return $list;
    }

    public function getNode(){
        $id = \Yii::$app->db->createCommand('SELECT `node_id` FROM `event_node` WHERE `id` = '.$this->id)->queryScalar();
        return Node::findOne($id);
    }

    public function getShow(){
        return [
            'id'=>$this->id,
            'name'=> $this->name,
            'students_names'=>$this->students_names,
            'time'=>$this->time,
            'number'=>$this->number_group,
            'event_type'=>Helper::getName( new EventType(),$this->event_type_id),
            'event_level'=>Helper::getName( new EventLevel(),$this->event_level_id),
            'teacher'=>Helper::getName(new User(),$this->teacher_id),
            'science_branch'=>Helper::getName(new ScienceBranch(),$this->science_branch_id),
            'specialty'=>Helper::getName(new Specialty(),$this->specialty_id),
            'reporting_d'=>Helper::getName(new ReportingD(),$this->reporting_d_id),
            'result'=>Helper::getName(new ReportingD(),$this->result_id),
        ];
    }
}