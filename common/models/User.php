<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\web\UploadedFile;
use common\components\MediaUploader;

/**
 * User model
 *
 * @property integer $id
 * @property int $profile_picture
 * @property string $name
 * @property string $username
 * @property string $auth_key 
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
* @property string $phone
* @property int $status
* @property int $created_by
* @property int $updated_by
* @property int $created_at
* @property int $updated_at
*
* @property Admission[] $admissions
* @property Admission[] $admissions0
* @property Division[] $divisions
* @property Division[] $divisions0
* @property DivisionStudent[] $divisionStudents
* @property DivisionStudent[] $divisionStudents0
* @property Exam[] $exams
* @property Exam[] $exams0
* @property ExamStudent[] $examStudents
* @property ExamStudent[] $examStudents0
* @property ExamStudentSubject[] $examStudentSubjects
* @property ExamStudentSubject[] $examStudentSubjects0
* @property ExamSubject[] $examSubjects
* @property ExamSubject[] $examSubjects0
* @property Fee[] $fees
* @property Fee[] $fees0
* @property Gallery[] $galleries
* @property Gallery[] $galleries0
* @property GalleryMedia[] $galleryMedia
* @property GalleryMedia[] $galleryMedia0
* @property Guardian[] $guardians
* @property Guardian[] $guardians0
* @property NewsEvent[] $newsEvents
* @property NewsEvent[] $newsEvents0
* @property Setting[] $settings
* @property Setting[] $settings0
* @property Student[] $students
* @property Student[] $students0
* @property StudentFee[] $studentFees
* @property StudentFee[] $studentFees0
* @property StudentGuardian[] $studentGuardians
* @property StudentGuardian[] $studentGuardians0
* @property Subject[] $subjects
* @property Subject[] $subjects0
* @property SubjectTeacher[] $subjectTeachers
* @property SubjectTeacher[] $subjectTeachers0
* @property SubjectTeacher[] $subjectTeachers1
* @property Media $profilePicture
* @property User $createdBy
* @property User[] $users
* @property User $updatedBy
* @property User[] $users0
 */
class User extends ActiveRecord implements IdentityInterface
{
	public $profilePictureFile, $password;
	
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

	public static $statuses = [
		self::STATUS_DELETED => 'Deleted',
		self::STATUS_ACTIVE => 'Active',
	];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
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
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['profilePictureFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg,png'],
			[['profile_picture', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
			[['name', 'username', 'auth_key', 'password_hash', 'email', 'phone'], 'required'],
			[['name', 'username', 'password_hash', 'password_reset_token', 'email', 'password'], 'string', 'max' => 255],
			[['auth_key'], 'string', 'max' => 32],
			[['phone'], 'string', 'max' => 20],
			[['username'], 'unique'],
			[['email'], 'unique'],
			[['password_reset_token'], 'unique'],
			[['profile_picture'], 'exist', 'skipOnError' => true, 'targetClass' => Media::className(), 'targetAttribute' => ['profile_picture' => 'id']],
			[['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
			[['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
			[['phone'], 'unique'],
		];
   }
	
    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
			if(!$insert && $this->password){
				$this->setPassword($this->password);
				$this->generateAuthKey();
			}
			$image = UploadedFile::getInstance($this, 'profilePictureFile');
			if($image){
				if($image != null && !$image->getHasError()) {
					if($mediaDetails = MediaUploader::uploadFiles($image)){
						$this->profile_picture = $mediaDetails['media_id'];
					}
				}
			}
            return true;
        } else {
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'profilePictureFile' => 'Profile Picture',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
	
	/*
    * @return \yii\db\ActiveQuery
    */
   public function getAdmissions()
   {
       return $this->hasMany(Admission::className(), ['created_by' => 'id']);
   }
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getAdmissions0()
   {
       return $this->hasMany(Admission::className(), ['updated_by' => 'id']);
   }
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getDivisions()
   {
       return $this->hasMany(Division::className(), ['created_by' => 'id']);
   }
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getDivisions0()
   {
       return $this->hasMany(Division::className(), ['updated_by' => 'id']);
   }
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getDivisionStudents()
   {
       return $this->hasMany(DivisionStudent::className(), ['created_by' => 'id']);
   }
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getDivisionStudents0()
   {
       return $this->hasMany(DivisionStudent::className(), ['updated_by' => 'id']);
   }
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getExams()
   {
       return $this->hasMany(Exam::className(), ['created_by' => 'id']);
   }
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getExams0()
   {
       return $this->hasMany(Exam::className(), ['updated_by' => 'id']);
   }
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getExamStudents()
   {
       return $this->hasMany(ExamStudent::className(), ['created_by' => 'id']);
   }
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getExamStudents0()
   {
       return $this->hasMany(ExamStudent::className(), ['updated_by' => 'id']);
   }
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getExamStudentSubjects()
   {
       return $this->hasMany(ExamStudentSubject::className(), ['created_by' => 'id']);
   }
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getExamStudentSubjects0()
   {
       return $this->hasMany(ExamStudentSubject::className(), ['updated_by' => 'id']);
   }
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getExamSubjects()
   {
       return $this->hasMany(ExamSubject::className(), ['created_by' => 'id']);
   }
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getExamSubjects0()
   {
       return $this->hasMany(ExamSubject::className(), ['updated_by' => 'id']);
   }
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getFees()
   {
       return $this->hasMany(Fee::className(), ['created_by' => 'id']);
   }
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getFees0()
   {
       return $this->hasMany(Fee::className(), ['updated_by' => 'id']);
   }
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getGalleries()
   {
       return $this->hasMany(Gallery::className(), ['created_by' => 'id']);
   }
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getGalleries0()
   {
       return $this->hasMany(Gallery::className(), ['updated_by' => 'id']);
   }
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getGalleryMedia()
   {
       return $this->hasMany(GalleryMedia::className(), ['created_by' => 'id']);
   }
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getGalleryMedia0()
   {
       return $this->hasMany(GalleryMedia::className(), ['updated_by' => 'id']);
   }
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getGuardians()
   {
       return $this->hasMany(Guardian::className(), ['created_by' => 'id']);
   }
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getGuardians0()
   {
       return $this->hasMany(Guardian::className(), ['updated_by' => 'id']);
   }
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getNewsEvents()
   {
       return $this->hasMany(NewsEvent::className(), ['created_by' => 'id']);
   }
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getNewsEvents0()
   {
       return $this->hasMany(NewsEvent::className(), ['updated_by' => 'id']);
   }
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getSettings()
   {
       return $this->hasMany(Setting::className(), ['created_by' => 'id']);
   }
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getSettings0()
   {
       return $this->hasMany(Setting::className(), ['updated_by' => 'id']);
   }
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getStudents()
   {
       return $this->hasMany(Student::className(), ['created_by' => 'id']);
   }
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getStudents0()
   {
       return $this->hasMany(Student::className(), ['updated_by' => 'id']);
   }
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getStudentFees()
   {
       return $this->hasMany(StudentFee::className(), ['created_by' => 'id']);
   }
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getStudentFees0()
   {
       return $this->hasMany(StudentFee::className(), ['updated_by' => 'id']);
   }
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getStudentGuardians()
   {
       return $this->hasMany(StudentGuardian::className(), ['created_by' => 'id']);
   }
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getStudentGuardians0()
   {
       return $this->hasMany(StudentGuardian::className(), ['updated_by' => 'id']);
   }
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getSubjects()
   {
       return $this->hasMany(Subject::className(), ['created_by' => 'id']);
   }
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getSubjects0()
   {
       return $this->hasMany(Subject::className(), ['updated_by' => 'id']);
   }
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getSubjectTeachers()
   {
       return $this->hasMany(SubjectTeacher::className(), ['teacher_id' => 'id']);
   }
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getSubjectTeachers0()
   {
       return $this->hasMany(SubjectTeacher::className(), ['created_by' => 'id']);
   }
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getSubjectTeachers1()
   {
       return $this->hasMany(SubjectTeacher::className(), ['updated_by' => 'id']);
   }
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getProfilePicture()
   {
       return $this->hasOne(Media::className(), ['id' => 'profile_picture']);
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
   public function getUsers()
   {
       return $this->hasMany(User::className(), ['created_by' => 'id']);
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
   public function getUsers0()
   {
       return $this->hasMany(User::className(), ['updated_by' => 'id']);
   }
}
