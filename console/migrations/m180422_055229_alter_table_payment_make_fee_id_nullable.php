<?php

use yii\db\Migration;

/**
 * Class m180422_055229_alter_table_payment_make_fee_id_nullable
 */
class m180422_055229_alter_table_payment_make_fee_id_nullable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->alterColumn('payment', 'fee_id', 'integer');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180422_055229_alter_table_payment_make_fee_id_nullable cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180422_055229_alter_table_payment_make_fee_id_nullable cannot be reverted.\n";

        return false;
    }
    */
}
