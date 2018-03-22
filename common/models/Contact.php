<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "contact".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property int $feedback_type
 * @property string $message
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class Contact extends \yii\db\ActiveRecord
{
	const TYPE_CONTACT = 1;
	const TYPE_FEEDBACK = 2;
	const TYPE_INQUIRY = 3;
	
	public static $types = [
		self::TYPE_CONTACT => 'Contact',
		self::TYPE_FEEDBACK => 'Feedback',
		self::TYPE_INQUIRY => 'Inquiry',
	];
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
		];
	}

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'surname'], 'required'],
            [['feedback_type', 'status', 'created_at', 'updated_at'], 'integer'],
            [['message'], 'string'],
            [['name', 'surname', 'email'], 'string', 'max' => 255],
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
            'surname' => 'Surname',
            'email' => 'Email',
            'feedback_type' => 'Type',
            'message' => 'Message',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
