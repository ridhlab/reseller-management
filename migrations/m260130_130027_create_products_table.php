<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products}}`.
 */
class m260130_130027_create_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%products}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'sell_price' => $this->integer()->notNull(),
            'original_price' => $this->integer()->notNull(),
            'seller_id' => $this->integer()->notNull(),
        ]);

        // Foreign key: products.seller_id -> sellers.id
        $this->addForeignKey(
            'fk-products-seller_id',      // nama constraint
            '{{%products}}',               // table yang punya FK
            'seller_id',                   // column FK
            '{{%sellers}}',                // table referensi
            'id',                          // column referensi
            'CASCADE',                     // ON DELETE
            'CASCADE'                      // ON UPDATE
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-products-seller_id', '{{%products}}');
        $this->dropTable('{{%products}}');
    }
}
