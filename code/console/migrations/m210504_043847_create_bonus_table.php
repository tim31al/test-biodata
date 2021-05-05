<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%bonus}}`.
 */
class m210504_043847_create_bonus_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('bonus', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->unique()->notNull(),
        ]);

        $rows = [
            ['Бесплатное обследование'],
            ['Скидка на поездку в санаторий'],
            ['Кружка с логотипом “БиоДата”']
        ];

        $this->batchInsert('bonus', ['title'], $rows);

        $this->createTable('bonus_limits', [
            'bonus_id' => $this->primaryKey(),
            'limit' => $this->integer()->defaultValue(null),
            'available' => $this->integer()->defaultValue(null)
        ]);

        $this->addForeignKey(
            'bonus_limit_fk',
            'bonus_limits',
            'bonus_id',
            'bonus',
            'id'
        );

        $rows = [
            [1, 10, 10],
            [2, null, null],
            [3, 5, 5]
        ];

        $this->batchInsert('bonus_limits', ['bonus_id', 'limit', 'available'], $rows);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('bonus_limit_fk', 'bonus_limits');
        $this->dropTable('bonus_limits');
        $this->dropTable('bonus');
    }
}
