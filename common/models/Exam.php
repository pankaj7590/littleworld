<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "exam".
 *
 * @property int $id
 * @property string $name
 * @property int $year
 * @property int $type
 * @property int $scheduled_date
 * @property int $status
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $updatedBy
 * @property User $createdBy
 * @property ExamStudent[] $examStudents
 * @property ExamStudentSubject[] $examStudentSubjects
 * @property ExamSubject[] $examSubjects
 */
class Exam extends \yii\db\ActiveRecord
{
	const STATUS_SCHEDULED = 1;
	const STATUS_ON_GOING = 2;
	const STATUS_CANCELLED = 3;
	const STATUS_OVER = 4;
	
	public static $statuses = [
		self::STATUS_SCHEDULED => 'Scheduled',
		self::STATUS_ON_GOING => 'On Going',
		self::STATUS_CANCELLED => 'Cancelled',
		self::STATUS_OVER => 'Over',
	];
	
	const TYPE_CLASS_TEST = 1;
	const TYPE_UNIT_TEST = 2;
	const TYPE_SEMESTER_TEST = 3;
	const TYPE_ANNUAL_TEST = 4;
	
	public static $types = [
		self::TYPE_CLASS_TEST => 'Class Test',
		self::TYPE_UNIT_TEST => 'Unit Test',
		self::TYPE_SEMESTER_TEST => 'Semester Test',
		self::TYPE_ANNUAL_TEST => 'Annual Test',
	];
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exam';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
			'blameable' => [
				'class' => BlameableBehavior::className(),
			],
		];
	}

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['year', 'type', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
			[['scheduled_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'year' => 'Year',
            'type' => 'Type',
            'scheduled_date' => 'Scheduled Date',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
	
    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
			if($this->scheduled_date){
				$this->scheduled_date = strtotime($this->scheduled_date);
			}
            return true;
        } else {
            return false;
        }
    }
	
    /**
     * @inheritdoc
     */
    public function afterFind()
    {	
		if($this->scheduled_date < time()){
			$this->updateAttributes(['status' => self::STATUS_ON_GOING]);
		}
		if($this->scheduled_date){
			$this->scheduled_date = Yii::$app->formatter->asDatetime($this->scheduled_date);
		}
        return parent::afterFind();
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
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExamStudents()
    {
        return $this->hasMany(ExamStudent::className(), ['exam_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExamStudentSubjects()
    {
        return $this->hasMany(ExamStudentSubject::className(), ['exam_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExamSubjects()
    {
        return $this->hasMany(ExamSubject::className(), ['exam_id' => 'id']);
    }
}
