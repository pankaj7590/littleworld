<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\web\UploadedFile;
use common\components\MediaUploader;

/**
 * This is the model class for table "gallery".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $type
 * @property int $status
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $updatedBy
 * @property User $createdBy
 * @property GalleryMedia[] $galleryMedia
 */
class Gallery extends \yii\db\ActiveRecord
{
	public $galleryPictures;
	
	const STATUS_SHOW = 1;
	const STATUS_HIDE = 0;
	
	public static $statuses = [
		self::STATUS_SHOW => 'Show',
		self::STATUS_HIDE => 'Hide',
	];
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gallery';
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
            [['description'], 'string'],
            [['galleryPictures'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg,png', 'maxFiles'=>0],
            [['type', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }
	
    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        if (parent::beforeSave($insert, $changedAttributes)) {
			$images = UploadedFile::getInstances($this, 'galleryPictures');
			foreach($images as $image){
				if($image){
					if($image != null && !$image->getHasError()) {
						if($mediaDetails = MediaUploader::uploadFiles($image)){
							$galleryMedia = new GalleryMedia();
							$galleryMedia->gallery_id = $this->id;
							$galleryMedia->media_id = $mediaDetails['media_id'];
							$galleryMedia->save();
						}
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
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'type' => 'Type',
            'status' => 'Show On Gallery Page',
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
    public function getGalleryMedia()
    {
        return $this->hasMany(GalleryMedia::className(), ['gallery_id' => 'id']);
    }
	
	public function getFirstImage(){
		return $this->hasOne(GalleryMedia::className(), ['gallery_id' => 'id']);
	}
}
