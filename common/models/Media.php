<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "media".
 *
 * @property int $id
 * @property int $media_type
 * @property string $alt
 * @property string $file_name
 * @property string $file_type
 * @property int $file_size
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property GalleryMedia[] $galleryMedia
 * @property Guardian[] $guardians
 * @property NewsEvent[] $newsEvents
 * @property User[] $users
 */
class Media extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'media';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['media_type', 'file_size', 'status', 'created_at', 'updated_at'], 'integer'],
            [['alt', 'file_name'], 'string', 'max' => 255],
            [['file_type'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'media_type' => 'Media Type',
            'alt' => 'Alt',
            'file_name' => 'File Name',
            'file_type' => 'File Type',
            'file_size' => 'File Size',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGalleryMedia()
    {
        return $this->hasMany(GalleryMedia::className(), ['media_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuardians()
    {
        return $this->hasMany(Guardian::className(), ['photo' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewsEvents()
    {
        return $this->hasMany(NewsEvent::className(), ['photo' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['profile_picture' => 'id']);
    }
}
