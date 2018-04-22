<?php

use yii\db\Migration;

/**
 * Class m180422_032903_alter_table_user_add_more_info_columns
 */
class m180422_032903_alter_table_user_add_more_info_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->addColumn('user', 'address', 'text after phone');
		$this->addColumn('user', 'experience', 'text after phone');
		$this->addColumn('user', 'qualification', 'text after phone');
		$this->addColumn('user', 'dob', 'integer after phone');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180422_032903_alter_table_user_add_more_info_columns cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180422_032903_alter_table_user_add_more_info_columns cannot be reverted.\n";

        return false;
    }
    */
}
