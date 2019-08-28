<?php

use yii\db\Migration;

/**
 * Class m190828_085425_create_lead_tbl
 */
class m190828_085425_create_lead_tbl extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('leads', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'source_id' => $this->integer(),
            'status' => $this->string(),
            'created_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('leads');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190828_085425_create_lead_tbl cannot be reverted.\n";

        return false;
    }
    */
}
