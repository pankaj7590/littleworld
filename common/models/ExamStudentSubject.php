<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "exam_student_subject".
 *
 * @property int $id
 * @property int $exam_student_id
 * @property int $exam_subject_id
 * @property int $exam_id
 * @property int $student_id
 * @property int $marks
 * @property int $secured_marks
 * @property string $grade
 * @property string $remarks
 * @property int $status
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $updatedBy
 * @property Exam $exam
 * @property ExamStudent $examStudent
 * @property ExamSubject $examSubject
 * @property Student $student
 * @property User $createdBy
 */
class ExamStudentSubject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exam_student_subject';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['exam_student_id', 'exam_subject_id', 'exam_id', 'student_id'], 'required'],
            [['exam_student_id', 'exam_subject_id', 'exam_id', 'student_id', 'marks', 'secured_marks', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['remarks'], 'string'],
            [['grade'], 'string', 'max' => 255],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['exam_id'], 'exist', 'skipOnError' => true, 'targetClass' => Exam::className(), 'targetAttribute' => ['exam_id' => 'id']],
            [['exam_student_id'], 'exist', 'skipOnError' => true, 'targetClass' => ExamStudent::className(), 'targetAttribute' => ['exam_student_id' => 'id']],
            [['exam_subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => ExamSubject::className(), 'targetAttribute' => ['exam_subject_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['student_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'exam_student_id' => 'Exam Student ID',
            'exam_subject_id' => 'Exam Subject ID',
            'exam_id' => 'Exam ID',
            'student_id' => 'Student ID',
            'marks' => 'Marks',
            'secured_marks' => 'Secured Marks',
            'grade' => 'Grade',
            'remarks' => 'Remarks',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExam()
    {
        return $this->hasOne(Exam::className(), ['id' => 'exam_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExamStudent()
    {
        return $this->hasOne(ExamStudent::className(), ['id' => 'exam_student_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExamSubject()
    {
        return $this->hasOne(ExamSubject::className(), ['id' => 'exam_subject_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::className(), ['id' => 'student_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
}
