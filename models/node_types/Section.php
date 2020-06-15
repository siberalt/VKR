<?php


namespace app\models\node_types;


use app\models\Status;
use app\models\User;
use yii\db\ActiveRecord;

class Section extends  ActiveRecord
{
    public function rules()
    {
        return [
            [
                [
                    'reporting_d_id',
                    'user_id'
                ],
                'safe'
            ],
            [
                [
                    'name',
                    'students_amount',
                ],
                'required', 'message' => 'Заполните поле'
            ],
        ];
    }

    public static function getList($id)
    {
        $list = [];

        if ($id == null) {
            $sections = Section::find()->all();
        }
        else {
            $sections = Section::find()->where(['user_id'=> $id])->all();
        }
        $list = [];
        foreach ($sections as $i => $section) {
            $status_id = \Yii::$app->db->createCommand('SELECT get_section_status(' . $section->id . ', ' . $section->user_id . ')')->queryScalar();
            $date = \Yii::$app->db->createCommand('SELECT get_section_date(' . $section->id . ', ' . $section->user_id . ')')->queryScalar();
            $status_name = Status::findOne($status_id)->name;
            $teacher = User::findOne($section->user_id);
            $teacher = isset($teacher) ? $teacher->name : null;
            $list[$i] = [
                'status_id' => $status_id,
                'status_name' => $status_name,
                'id' => $section->id,
                'teacher' => $teacher,
                'name' => $section->name,
                'students_amount' => $section->students_amount,
                'date' => $date
            ];

        }
        return $list;

    }

    public function getNode(){
        $id = \Yii::$app->db->createCommand('SELECT `node_id` FROM `section_node` WHERE `id` = '.$this->id)->queryScalar();
        return Node::findOne($id);
    }

    public function getShow(){
        $node =$this->getNode();
        return [
            'id'=>$this->id,
            'name'=> $this->name,
            'amount'=>$this->students_amount,
            'reporting_d_id'=>$this->reporting_d_id,
            'teacher_id'=>$this->user_id,
            'status_id'=>$node->status_id,
            'date'=>$node->creation_date
        ];
    }
}