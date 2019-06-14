<?php
/**
 * m180420_065538_init class file.
 */

use yii\db\Migration;

/**
 * Class m180420_065538_init
 */
class m180420_065538_init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        /** Creating tables **/

        $this->createTable('{{%request}}', [
            'request_id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'phone' => $this->string(255)->notNull(),
            'email' => $this->string(255)->notNull(),
            'education' => $this->string(255)->notNull(),
            'english_level' => $this->string(255)->notNull(),
            'birthday_date' => $this->string(255)->notNull(),
            'status' => 'TINYINT(1) NOT NULL',
            'created_at' => $this->integer(11)->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%request}}');
    }
}
