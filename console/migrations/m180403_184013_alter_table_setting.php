<?php

use yii\db\Migration;

/**
 * Class m180403_184013_alter_table_setting
 */
class m180403_184013_alter_table_setting extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
		$this->alterColumn('setting', 'default_value', 'text');
		$this->alterColumn('setting', 'value', 'text');
		$this->addColumn('setting', 'setting_group', 'smallint after id');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180403_184013_alter_table_setting cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180403_184013_alter_table_setting cannot be reverted.\n";

        return false;
    }
    */
}
