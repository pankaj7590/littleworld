<?php

namespace common\models;

use Yii;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\web\UploadedFile;
use common\components\MediaUploader;

/**
 * This is the model class for table "guardian".
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property int $dob
 * @property int $photo
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $phone
 * @property int $status
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $updatedBy
 * @property Media $photo0
 * @property User $createdBy
 * @property Payment[] $payments
 * @property Payment[] $payments0
 * @property Payment[] $payments1
 * @property StudentGuardian[] $studentGuardians
 */
class Guardian extends \yii\db\ActiveRecord implements IdentityInterface
{
	public $guardian_relation;
	public $student_id;
	public $profilePictureFile, $password;
	
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'guardian';
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
            [['name', 'address', 'username', 'auth_key', 'password_hash', 'email', 'phone'], 'required'],
            [['profilePictureFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg,png'],
            [['address'], 'string'],
            [['photo', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at', 'guardian_relation'], 'integer'],
            [['name', 'username', 'password_hash', 'password_reset_token', 'email', 'password'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['phone'], 'string', 'max' => 20],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['photo'], 'exist', 'skipOnError' => true, 'targetClass' => Media::className(), 'targetAttribute' => ['photo' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
			[['dob'], 'safe'],
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
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'phone' => 'Phone',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'guardian_relation' => 'Relation',
            'profilePictureFile' => 'Profile Picture',
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
    public function getPhotoPicture()
    {
        return $this->hasOne(Media::className(), ['id' => 'photo']);
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
    public function getPayments()
    {
        return $this->hasMany(Payment::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments0()
    {
        return $this->hasMany(Payment::className(), ['guardian_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments1()
    {
        return $this->hasMany(Payment::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentGuardians()
    {
        return $this->hasMany(StudentGuardian::className(), ['guardian_id' => 'id']);
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
	
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getProfilePicture()
   {
       return $this->hasOne(Media::className(), ['id' => 'profile_picture']);
   }
}
