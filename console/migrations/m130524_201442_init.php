<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
		
		$this->createTable("media",[
			'id' => $this->primaryKey(),
			'media_type' => $this->smallInteger(4),
			'alt' => $this->string(255),
			'file_name' => $this->string(255),
			'file_type' => $this->string(45),
			'file_size' => $this->integer(10),
			'status' => $this->smallInteger(),
			'created_at' => $this->integer(11),
			'updated_at' => $this->integer(11),
		], $tableOptions);

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
			'profile_picture' => $this->integer(),
            'name' => $this->string()->notNull(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'phone' => $this->string(20)->notNull(),

            'status' => $this->smallInteger()->defaultValue(10),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);
		
		$this->addForeignKey('fk_user_media', 'user', 'profile_picture', 'media', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_user_user_created_by', 'user', 'created_by', 'user', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_user_user_updated_by', 'user', 'updated_by', 'user', 'id', 'SET NULL', 'SET NULL');
		
		$this->createTable("contact", [
			'id' => $this->primaryKey(),
			'name' => $this->string()->notNull(),
			'surname' => $this->string()->notNull(),
			'email' => $this->string(),
			'feedback_type' => $this->smallInteger(),
			'message' => $this->text(),
			
            'status' => $this->smallInteger()->defaultValue(10),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
		], $tableOptions);
		
		$this->createTable("gallery", [
			'id' => $this->primaryKey(),
			'name' => $this->string(),
			'description' => $this->text(),
			'type' => $this->smallInteger(),
			
            'status' => $this->smallInteger()->defaultValue(10),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
		], $tableOptions);
		$this->addForeignKey('fk_gallery_user_created_by', 'gallery', 'created_by', 'user', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_gallery_user_updated_by', 'gallery', 'updated_by', 'user', 'id', 'SET NULL', 'SET NULL');
		
		$this->createTable("gallery_media", [
			'id' => $this->primaryKey(),
			'gallery_id' => $this->integer()->notNull(),
			'media_id' => $this->integer()->notNull(),
			
            'status' => $this->smallInteger()->defaultValue(10),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
		], $tableOptions);
		$this->addForeignKey('fk_gallery_media_gallery', 'gallery_media', 'gallery_id', 'gallery', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_gallery_media_media', 'gallery_media', 'media_id', 'media', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_gallery_media_user_created_by', 'gallery_media', 'created_by', 'user', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_gallery_media_user_updated_by', 'gallery_media', 'updated_by', 'user', 'id', 'SET NULL', 'SET NULL');
		
		$this->createTable("setting", [
			'id' => $this->primaryKey(),
			'name' => $this->string()->notNull()->unique(),
			'label' => $this->string()->notNull(),
			'default_value' => $this->text()->notNull(),
			'value' => $this->text()->notNull(),
			
            'status' => $this->smallInteger()->defaultValue(10),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
		], $tableOptions);
		$this->addForeignKey('fk_setting_user_created_by', 'setting', 'created_by', 'user', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_setting_user_updated_by', 'setting', 'updated_by', 'user', 'id', 'SET NULL', 'SET NULL');
		
		$this->createTable("student", [
			'id' => $this->primaryKey(),
			'name' => $this->string()->notNull(),
			'address' => $this->text()->notNull(),
			'dob' => $this->integer(),
			'photo' => $this->integer(),
			
            'status' => $this->smallInteger()->defaultValue(10),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
		], $tableOptions);
		$this->addForeignKey('fk_student_user_created_by', 'student', 'created_by', 'user', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_student_user_updated_by', 'student', 'updated_by', 'user', 'id', 'SET NULL', 'SET NULL');
		
		$this->createTable("guardian", [
			'id' => $this->primaryKey(),
			'name' => $this->string()->notNull(),
			'address' => $this->text()->notNull(),
			'dob' => $this->integer(),
			'photo' => $this->integer(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'phone' => $this->string(20)->notNull(),
			
            'status' => $this->smallInteger()->defaultValue(10),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
		], $tableOptions);
		$this->addForeignKey('fk_guardian_media', 'guardian', 'photo', 'media', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_guardian_user_created_by', 'guardian', 'created_by', 'user', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_guardian_user_updated_by', 'guardian', 'updated_by', 'user', 'id', 'SET NULL', 'SET NULL');
		
		$this->createTable("student_guardian", [
			'id' => $this->primaryKey(),
			'student_id' => $this->integer()->notNull(),
			'guardian_id' => $this->integer()->notNull(),
			'relation' => $this->smallInteger(),
			
            'status' => $this->smallInteger()->defaultValue(10),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
		], $tableOptions);
		$this->addForeignKey('fk_student_guardian_student', 'student_guardian', 'student_id', 'student', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_student_guardian_guardian', 'student_guardian', 'guardian_id', 'guardian', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_student_guardian_user_created_by', 'student_guardian', 'created_by', 'user', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_student_guardian_user_updated_by', 'student_guardian', 'updated_by', 'user', 'id', 'SET NULL', 'SET NULL');
		
		$this->createTable("division", [
			'id' => $this->primaryKey(),
			'year' => $this->integer(),
			'name' => $this->string(),
			
            'status' => $this->smallInteger()->defaultValue(10),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
		], $tableOptions);
		$this->addForeignKey('fk_division_user_created_by', 'division', 'created_by', 'user', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_division_user_updated_by', 'division', 'updated_by', 'user', 'id', 'SET NULL', 'SET NULL');
		
		$this->createTable("division_student", [
			'id' => $this->primaryKey(),
			'division_id' => $this->integer()->notNull(),
			'student_id' => $this->integer()->notNull(),
			
            'status' => $this->smallInteger()->defaultValue(10),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
		], $tableOptions);
		$this->addForeignKey('fk_division_student_division', 'division_student', 'division_id', 'division', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_division_student_student', 'division_student', 'student_id', 'student', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_division_student_user_created_by', 'division_student', 'created_by', 'user', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_division_student_user_updated_by', 'division_student', 'updated_by', 'user', 'id', 'SET NULL', 'SET NULL');
		
		$this->createTable("fee", [
			'id' => $this->primaryKey(),
			'year' => $this->integer(),
			'type' => $this->smallInteger(),
			'amount' => $this->double(),
			
            'status' => $this->smallInteger()->defaultValue(10),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
		], $tableOptions);
		$this->addForeignKey('fk_fee_user_created_by', 'fee', 'created_by', 'user', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_fee_user_updated_by', 'fee', 'updated_by', 'user', 'id', 'SET NULL', 'SET NULL');
		
		$this->createTable("student_fee", [
			'id' => $this->primaryKey(),
			'student_id' => $this->integer()->notNull(),
			'fee_id' => $this->integer()->notNull(),
			'type' => $this->smallInteger(),
			'amount' => $this->double(),
			'is_paid' => $this->smallInteger(),
			
            'status' => $this->smallInteger()->defaultValue(10),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
		], $tableOptions);
		$this->addForeignKey('fk_student_fee_student', 'student_fee', 'student_id', 'student', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_student_fee_fee', 'student_fee', 'fee_id', 'fee', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_student_fee_user_created_by', 'student_fee', 'created_by', 'user', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_student_fee_user_updated_by', 'student_fee', 'updated_by', 'user', 'id', 'SET NULL', 'SET NULL');
		
		$this->createTable("admission", [
			'id' => $this->primaryKey(),
			'student_id' => $this->integer()->notNull(),
			'year' => $this->integer()->notNull(),
			'fee' => $this->double(),
			'is_paid' => $this->smallInteger(),
			
            'status' => $this->smallInteger()->defaultValue(10),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
		], $tableOptions);
		$this->addForeignKey('fk_admission_student', 'admission', 'student_id', 'student', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_admission_user_created_by', 'admission', 'created_by', 'user', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_admission_user_updated_by', 'admission', 'updated_by', 'user', 'id', 'SET NULL', 'SET NULL');
		
		$this->createTable("exam", [
			'id' => $this->primaryKey(),
			'name' => $this->string()->notNull(),
			'year' => $this->integer(),
			'type' => $this->smallInteger(),
			'scheduled_date' => $this->integer(),
			
            'status' => $this->smallInteger()->defaultValue(10),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
		], $tableOptions);
		$this->addForeignKey('fk_exam_user_created_by', 'exam', 'created_by', 'user', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_exam_user_updated_by', 'exam', 'updated_by', 'user', 'id', 'SET NULL', 'SET NULL');
		
		
		$this->createTable("subject", [
			'id' => $this->primaryKey(),
			'name' => $this->string()->notNull(),
			
            'status' => $this->smallInteger()->defaultValue(10),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
		], $tableOptions);
		$this->addForeignKey('fk_subject_user_created_by', 'subject', 'created_by', 'user', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_subject_user_updated_by', 'subject', 'updated_by', 'user', 'id', 'SET NULL', 'SET NULL');
		
		$this->createTable("subject_teacher", [
			'id' => $this->primaryKey(),
			'subject_id' => $this->integer()->notNull(),
			'teacher_id' => $this->integer()->notNull(),
			
            'status' => $this->smallInteger()->defaultValue(10),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
		], $tableOptions);
		$this->addForeignKey('fk_subject_teacher_subject', 'subject_teacher', 'subject_id', 'subject', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_subject_teacher_teacher', 'subject_teacher', 'teacher_id', 'user', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_subject_teacher_user_created_by', 'subject_teacher', 'created_by', 'user', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_subject_teacher_user_updated_by', 'subject_teacher', 'updated_by', 'user', 'id', 'SET NULL', 'SET NULL');
		
		$this->createTable("exam_subject", [
			'id' => $this->primaryKey(),
			'exam_id' => $this->integer()->notNull(),
			'subject_id' => $this->integer()->notNull(),
			'marks' => $this->integer(),
			
            'status' => $this->smallInteger()->defaultValue(10),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
		], $tableOptions);
		$this->addForeignKey('fk_exam_subject_exam', 'exam_subject', 'exam_id', 'exam', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_exam_subject_subject', 'exam_subject', 'subject_id', 'subject', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_exam_subject_user_created_by', 'exam_subject', 'created_by', 'user', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_exam_subject_user_updated_by', 'exam_subject', 'updated_by', 'user', 'id', 'SET NULL', 'SET NULL');
		
		$this->createTable("exam_student", [
			'id' => $this->primaryKey(),
			'exam_id' => $this->integer()->notNull(),
			'student_id' => $this->integer()->notNull(),
			
            'status' => $this->smallInteger()->defaultValue(10),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
		], $tableOptions);
		$this->addForeignKey('fk_exam_student_exam', 'exam_student', 'exam_id', 'exam', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_exam_student_student', 'exam_student', 'student_id', 'student', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_exam_student_user_created_by', 'exam_student', 'created_by', 'user', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_exam_student_user_updated_by', 'exam_student', 'updated_by', 'user', 'id', 'SET NULL', 'SET NULL');
		
		$this->createTable("exam_student_subject", [
			'id' => $this->primaryKey(),
			'exam_student_id' => $this->integer()->notNull(),
			'exam_subject_id' => $this->integer()->notNull(),
			'exam_id' => $this->integer()->notNull(),
			'student_id' => $this->integer()->notNull(),
			'marks' => $this->integer(),
			'secured_marks' => $this->integer(),
			'grade' => $this->string(),
			'remarks' => $this->text(),
			
            'status' => $this->smallInteger()->defaultValue(10),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
		], $tableOptions);
		$this->addForeignKey('fk_exam_student_subject_exam_student', 'exam_student_subject', 'exam_student_id', 'exam_student', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_exam_student_subject_exam_subject', 'exam_student_subject', 'exam_subject_id', 'exam_subject', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_exam_student_subject_exam', 'exam_student_subject', 'exam_id', 'exam', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_exam_student_subject_student', 'exam_student_subject', 'student_id', 'student', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_exam_student_subject_user_created_by', 'exam_student_subject', 'created_by', 'user', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_exam_student_subject_user_updated_by', 'exam_student_subject', 'updated_by', 'user', 'id', 'SET NULL', 'SET NULL');
    
		$this->createTable("news_event", [
			'id' => $this->primaryKey(),
			'title' => $this->string()->notNull(),
			'content' => $this->text()->notNull(),
			'photo' => $this->integer(),
			'news_event_date' => $this->integer(),
			'type' => $this->smallInteger(),
			'place' => $this->text(),
			
			'status' => $this->smallInteger(),
			'created_by' => $this->integer(),
			'updated_by' => $this->integer(),
			'created_at' => $this->integer(),
			'updated_at' => $this->integer(),
		], $tableOptions);
		
		$this->addForeignKey('fk_news_event_photo', 'news_event', 'photo', 'media', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_news_event_user_created_by', 'news_event', 'created_by', 'user', 'id', 'SET NULL', 'SET NULL');
		$this->addForeignKey('fk_news_event_user_updated_by', 'news_event', 'updated_by', 'user', 'id', 'SET NULL', 'SET NULL');
	}

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
