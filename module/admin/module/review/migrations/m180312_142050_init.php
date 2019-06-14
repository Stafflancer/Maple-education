<?php
/**
 * m180312_142050_init class file.
 */

use yii\db\Migration;

/**
 * Class m180312_142050_init
 */
class m180312_142050_init extends Migration
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

        $this->createTable('{{%review}}', [
            'review_id' => $this->primaryKey(),
            'banner_id' => $this->integer(11)->notNull(),
            'image' => $this->string(255)->notNull(),
            'status' => 'TINYINT(1) NOT NULL',
            'sort_order' => $this->integer(3)->notNull(),
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
        ], $tableOptions);

        $this->createTable('{{%review_description}}', [
            'review_id' => $this->integer(11)->notNull(),
            'language_id' => $this->integer(11)->notNull(),
            'author' => $this->string(255)->notNull(),
            'title' => $this->string(255)->notNull(),
            'text' => $this->text()->notNull(),
        ], $tableOptions);

        $this->createIndex('banner_id', '{{%review}}', 'banner_id');

        $this->addPrimaryKey('{{%review_description}}', '{{%review_description}}', ['review_id', 'language_id']);

        /** Creating demo data **/
        $this->execute(file_get_contents(__DIR__ . '/init.sql'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropPrimaryKey('{{%review_description}}', '{{%review_description}}');
        $this->dropIndex('banner_id', '{{%review}}');
        $this->dropTable('{{%review_description}}');
        $this->dropTable('{{%review}}');
    }
}
