<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ExamStudentSubject;

/**
 * ExamStudentSubjectSearch represents the model behind the search form of `common\models\ExamStudentSubject`.
 */
class ExamStudentSubjectSearch extends ExamStudentSubject
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'exam_student_id', 'exam_subject_id', 'exam_id', 'student_id', 'marks', 'secured_marks', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['grade', 'remarks'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ExamStudentSubject::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'exam_student_id' => $this->exam_student_id,
            'exam_subject_id' => $this->exam_subject_id,
            'exam_id' => $this->exam_id,
            'student_id' => $this->student_id,
            'marks' => $this->marks,
            'secured_marks' => $this->secured_marks,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'grade', $this->grade])
            ->andFilterWhere(['like', 'remarks', $this->remarks]);

        return $dataProvider;
    }
}
