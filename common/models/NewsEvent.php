<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\web\UploadedFile;
use common\components\MediaUploader;

/**
 * This is the model class for table "news_event".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int $photo
 * @property int $news_event_date
 * @property int $type
 * @property string $place
 * @property int $status
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $updatedBy
 * @property Media $photo0
 * @property User $createdBy
 */
class NewsEvent extends \yii\db\ActiveRecord
{
	public $photoPictureFile;
	
	const TYPE_NEWS = 1;
	const TYPE_EVENT = 2;
	
	public static $types = [
		self::TYPE_NEWS => 'News',
		self::TYPE_EVENT => 'Events',
	];
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news_event';
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
            [['title', 'content'], 'required'],
            [['photoPictureFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg,png'],
            [['content', 'place'], 'string'],
            [['photo', 'type', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['photo'], 'exist', 'skipOnError' => true, 'targetClass' => Media::className(), 'targetAttribute' => ['photo' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
			[['news_event_date'], 'safe'],
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
			if($this->news_event_date){
				$this->news_event_date = strtotime($this->news_event_date);
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
		if($this->news_event_date){
			$this->news_event_date = Yii::$app->formatter->asDatetime($this->news_event_date);
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
            'title' => 'Title',
            'content' => 'Content',
            'photo' => 'Photo',
            'photoPictureFile' => 'Photo',
            'news_event_date' => 'Date',
            'type' => 'Type',
            'place' => 'Place',
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
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
	
   /**
    * @return \yii\db\ActiveQuery
    */
   public function getPhotoPicture()
   {
       return $this->hasOne(Media::className(), ['id' => 'photo']);
   }
}
