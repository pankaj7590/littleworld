<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\web\UploadedFile;
use common\components\MediaUploader;

/**
 * This is the model class for table "student".
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property int $dob
 * @property int $photo
 * @property int $status
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Admission[] $admissions
 * @property DivisionStudent[] $divisionStudents
 * @property ExamStudent[] $examStudents
 * @property ExamStudentSubject[] $examStudentSubjects
 * @property Payment[] $payments
 * @property User $updatedBy
 * @property User $createdBy
 * @property StudentFee[] $studentFees
 * @property StudentGuardian[] $studentGuardians
 */
class Student extends \yii\db\ActiveRecord
{
	public $photoPictureFile;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student';
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
            [['name', 'address'], 'required'],
            [['photoPictureFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg,png'],
            [['address'], 'string'],
            [['photo', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
			[['dob'], 'safe'],
        ];
    }
	
    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
			$image = UploadedFile::getInstance($this, 'photoPictureFile');
			if($image){
				if($image != null && !$image->getHasError()) {
					if($mediaDetails = MediaUploader::uploadFiles($image)){
						$this->photo = $mediaDetails['media_id'];
					}
				}
			}
			if($this->dob){
				$this->dob = strtotime($this->dob);
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
		if($this->dob){
			$this->dob = Yii::$app->formatter->asDate($this->dob);
		}
        return parent::afterFind();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'address' => 'Address',
            'dob' => 'Date Of Birth',
            'photo' => 'Photo',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'photoPictureFile' => 'Profile Picture',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdmissions()
    {
        return $this->hasMany(Admission::className(), ['student_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDivisionStudents()
    {
        return $this->hasMany(DivisionStudent::className(), ['student_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrentDivision()
    {
        return $this->hasOne(DivisionStudent::className(), ['student_id' => 'id'])->joinWith('division')->where(['year' => date('Y')]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExamStudents()
    {
        return $this->hasMany(ExamStudent::className(), ['student_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExamStudentSubjects()
    {
        return $this->hasMany(ExamStudentSubject::className(), ['student_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payment::className(), ['student_id' => 'id']);
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
    public function getStudentFees()
    {
        return $this->hasMany(StudentFee::className(), ['student_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentGuardians()
    {
        return $this->hasMany(StudentGuardian::className(), ['student_id' => 'id']);
    }
	
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getPhotoPicture()
   {
       return $this->hasOne(Media::className(), ['id' => 'photo']);
   }
	
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getExamStudentSubject($exam, $exam_subject)
   {
       return $this->hasOne(ExamStudentSubject::className(), ['student_id' => 'id'])->where(['exam_id' => $exam, 'exam_subject_id' => $exam_subject]);
   }
}
