<?php


namespace app\models\node_types;


use app\Helper;
use app\models\PublicationStatus;
use app\models\ScienceBranch;
use app\models\Specialty;
use app\models\Status;
use app\models\Teacher;
use app\models\User;
use yii\db\ActiveRecord;

class Work extends ActiveRecord
{
    public function rules()
    {
        return [
            [
                [
                    'head_id',
                ],
                'safe'
            ],
            [
                [
                    'name',
                    'status_id',
                    'specialty_id',
                    'students_names',
                    'science_branch_id'
                ],
                'required', 'message' => 'Заполните поле'
            ],
        ];
    }

    public static function getList($id)
    {
        $list = [];

        if ($id == null) {
            $works = Work::find()->all();
        }
        else {
            $works = Work::find()->where(['head_id'=> $id])->all();
        }
        $list = [];
        foreach ($works as $i => $work) {
            $status_id = \Yii::$app->db->createCommand('SELECT get_work_status(' . $work->id . ', ' . $work->head_id . ')')->queryScalar();
            $date = \Yii::$app->db->createCommand('SELECT get_work_date(' . $work->id . ', ' . $work->head_id . ')')->queryScalar();

            $status_name = Status::findOne($status_id);
            $status_name = isset($status_name) ? $status_name->name : null;

            $teacher = User::findOne($work->head_id);
            $teacher = isset($teacher) ? $teacher->name : null;

            $science_branch = ScienceBranch::findOne($work->science_branch_id);
            $science_branch = isset($science_branch) ? $science_branch->name : null;
            $list[$i] = [
                'status_id' => $status_id,
                'status_name' => $status_name,
                'id' => $work->id,
                'teacher' => $teacher,
                'name' => $work->name,
                'students_names' => $work->students_names,
                'science_branch'=> $science_branch,
                'date' => $date
            ];
        }
        return $list;
    }

    public function getNode(){
        $id = \Yii::$app->db->createCommand('SELECT `node_id` FROM `work_node` WHERE `id` = '.$this->id)->queryScalar();
        return Node::findOne($id);
    }

    public function getShow(){
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'students_names'=> $this->students_names,
            'teacher_name'=> Helper::getName(new User(),$this->head_id),
            'number'=>$this->number_group,
            'pub_status'=>Helper::getName(new PublicationStatus(), $this->status_id),
            'science_branch'=>Helper::getName(new ScienceBranch(), $this->science_branch_id),
            'specialty'=>Helper::getName(new Specialty(),$this->specialty_id),
        ];
    }
}