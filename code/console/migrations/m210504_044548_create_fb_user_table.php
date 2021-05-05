<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%fb_user}}`.
 */
class m210504_044548_create_fb_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%fb_user}}', [
            'id' => $this->bigPrimaryKey(),
            'created_at' => $this->integer()->notNull(),
            'bonus_id' => $this->integer(),
        ]);

        $this->addForeignKey('bonus_fk', 'fb_user', 'bonus_id', 'bonus', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('bonus_fk', 'fb_user');
        $this->dropTable('{{%fb_user}}');
    }
}
