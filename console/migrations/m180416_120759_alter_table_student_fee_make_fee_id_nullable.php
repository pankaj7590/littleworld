<?php

use yii\db\Migration;

/**
 * Class m180416_120759_alter_table_student_fee_make_fee_id_nullable
 */
class m180416_120759_alter_table_student_fee_make_fee_id_nullable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->alterColumn('student_fee', 'fee_id', 'integer');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180416_120759_alter_table_student_fee_make_fee_id_nullable cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180416_120759_alter_table_student_fee_make_fee_id_nullable cannot be reverted.\n";

        return false;
    }
    */
}
