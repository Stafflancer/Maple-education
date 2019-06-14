<?php
/**
 * m180419_143000_init class file.
 */

use yii\db\Migration;

/**
 * Class m180419_143000_init
 */
class m180419_143000_init extends Migration
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

        $this->createTable('{{%faq_category}}', [
            'faq_category_id' => $this->primaryKey(),
            'status' => 'TINYINT(1) NOT NULL',
            'sort_order' => $this->integer(3)->notNull(),
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
        ], $tableOptions);

        $this->createTable('{{%faq_category_description}}', [
            'faq_category_id' => $this->integer(11)->notNull(),
            'language_id' => $this->integer(11)->notNull(),
            'name' => $this->string(255)->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('{{%faq_category_description}}', '{{%faq_category_description}}', ['faq_category_id', 'language_id']);

        $this->createIndex('name', '{{%faq_category_description}}', 'name');

        $this->createTable('{{%faq}}', [
            'faq_id' => $this->primaryKey(),
            'faq_category_id' => $this->integer(11)->notNull(),
            'status' => 'TINYINT(1) NOT NULL',
            'sort_order' => $this->integer(3)->notNull(),
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
        ], $tableOptions);

        $this->createIndex('faq_category_id', '{{%faq}}', 'faq_category_id');

        $this->createTable('{{%faq_description}}', [
            'faq_id' => $this->integer(11)->notNull(),
            'language_id' => $this->integer(11)->notNull(),
            'question' => $this->text()->notNull(),
            'answer' => $this->text()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('{{%faq_description}}', '{{%faq_description}}', ['faq_id', 'language_id']);

        /** Creating demo data **/
        $this->execute(file_get_contents(__DIR__ . '/init.sql'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropPrimaryKey('{{%faq_description}}', '{{%faq_description}}');
        $this->dropTable('{{%faq_description}}');
        $this->dropIndex('faq_category_id', '{{%faq}}');
        $this->dropTable('{{%faq}}');
        $this->dropIndex('name', '{{%faq_category_description}}');
        $this->dropPrimaryKey('{{%faq_category_description}}', '{{%faq_category_description}}');
        $this->dropTable('{{%faq_category_description}}');
        $this->dropTable('{{%faq_category}}');
    }
}
