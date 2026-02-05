<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%daily_sold_products}}`.
 */
class m260130_130903_create_daily_sold_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%daily_sold_products}}', [
            'id' => $this->primaryKey(),
            'date' => $this->date()->notNull(),
            'stock' => $this->integer()->notNull(),
            'sold' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-daily-product-sold-product_id',
            '{{%daily_sold_products}}',
            'product_id',
            '{{%products}}',
            'id',
            'cascade',
            'cascade'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-daily-product-sold-product_id', '{{%daily_sold_products}}');
        $this->dropTable('{{%daily_sold_products}}');
    }
}
