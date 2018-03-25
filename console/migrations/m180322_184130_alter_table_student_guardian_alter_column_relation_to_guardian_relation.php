<?php

use yii\db\Migration;

/**
 * Class m180322_184130_alter_table_student_guardian_alter_column_relation_to_guardian_relation
 */
class m180322_184130_alter_table_student_guardian_alter_column_relation_to_guardian_relation extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
		$this->dropColumn('student_guardian', 'relation');
		$this->addColumn('student_guardian', 'guardian_relation', 'smallint after guardian_id');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180322_184130_alter_table_student_guardian_alter_column_relation_to_guardian_relation cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180322_184130_alter_table_student_guardian_alter_column_relation_to_guardian_relation cannot be reverted.\n";

        return false;
    }
    */
}
