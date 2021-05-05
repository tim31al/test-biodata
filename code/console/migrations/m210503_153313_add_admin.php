<?php

use yii\db\Migration;

/**
 * Class m210503_153313_add_admin
 */
class m210503_153313_add_admin extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $username = getenv('ADMIN_USERNAME');
        $password = getenv('ADMIN_PASSWORD');
        $email = getenv('ADMIN_EMAIL');

        $passHash = \Yii::$app->security->generatePasswordHash($password);
        $authKey = \Yii::$app->security->generateRandomString();

        $dateTime = strtotime('now');

        $this->insert('user', [
            'username' => $username,
            'password_hash' => $passHash,
            'email' => $email,
            'auth_key' => $authKey,
            'created_at' => $dateTime,
            'updated_at' => $dateTime,
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210503_153313_add_admin cannot be reverted.\n";

        return false;
    }


    protected function readLine()
    {
        return rtrim(fgets(STDIN));
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210503_153313_add_admin cannot be reverted.\n";

        return false;
    }
    */
}
