<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "payment".
 *
 * @property int $id
 * @property int $guardian_id
 * @property int $student_id
 * @property int $fee_id
 * @property string $email
 * @property string $mobile
 * @property double $amount
 * @property int $status
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Guardian $updatedBy
 * @property Fee $fee
 * @property Guardian $guardian
 * @property Guardian $createdBy
 * @property Student $student
 */
class Payment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['guardian_id', 'student_id', 'fee_id', 'amount'], 'required'],
            [['guardian_id', 'student_id', 'fee_id', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['amount'], 'number'],
            [['email', 'mobile'], 'string', 'max' => 255],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => Guardian::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['fee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Fee::className(), 'targetAttribute' => ['fee_id' => 'id']],
            [['guardian_id'], 'exist', 'skipOnError' => true, 'targetClass' => Guardian::className(), 'targetAttribute' => ['guardian_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => Guardian::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['student_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'guardian_id' => 'Guardian ID',
            'student_id' => 'Student ID',
            'fee_id' => 'Fee ID',
            'email' => 'Email',
            'mobile' => 'Mobile',
            'amount' => 'Amount',
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
        return $this->hasOne(Guardian::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFee()
    {
        return $this->hasOne(Fee::className(), ['id' => 'fee_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuardian()
    {
        return $this->hasOne(Guardian::className(), ['id' => 'guardian_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(Guardian::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::className(), ['id' => 'student_id']);
    }
}
