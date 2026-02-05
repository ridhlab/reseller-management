<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sellers}}`.
 */
class m260130_125632_create_sellers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%sellers}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%sellers}}');
    }
}
