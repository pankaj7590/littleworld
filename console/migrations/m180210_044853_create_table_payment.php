<?php

use yii\db\Migration;

/**
 * Class m180210_044853_create_table_payment
 */
class m180210_044853_create_table_payment extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
		
		$this->createTable("payment", [
			'id' => $this->primaryKey(),
			'guardian_id' => $this->integer()->notNull(),
			'student_id' => $this->integer()->notNull(),
			'fee_id' => $this->integer()->notNull(),
			'email' => $this->string(),
			'mobile' => $this->string(),
			'amount' => $this->double()->notNull(),
			'status' => $this->smallInteger(),
			'created_by' => $this->integer(),
			'updated_by' => $this->integer(),
			'created_at' => $this->integer(),
			'updated_at' => $this->integer(),
		], $tableOptions);
		
		$this->addForeignKey('fk_payment_guardian', 'payment', 'guardian_id', 'guardian', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_payment_student', 'payment', 'student_id', 'student', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_payment_fee', 'payment', 'fee_id', 'fee', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_payment_guardian_created_by', 'payment', 'created_by', 'guardian', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_payment_guardian_updated_by', 'payment', 'updated_by', 'guardian', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180210_044853_create_table_payment cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180210_044853_create_table_payment cannot be reverted.\n";

        return false;
    }
    */
}
