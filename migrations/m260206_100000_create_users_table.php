<?php

use yii\db\Migration;

class m260206_100000_create_users_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'username' => $this->string(255)->notNull()->unique(),
            'password_hash' => $this->string(255)->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        // Seed admin user
        $adminPassword = Yii::$app->params['adminPassword'];
        $this->insert('users', [
            'username' => 'admin',
            'password_hash' => Yii::$app->security->generatePasswordHash($adminPassword),
            'auth_key' => Yii::$app->security->generateRandomString(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('users');
    }
}
