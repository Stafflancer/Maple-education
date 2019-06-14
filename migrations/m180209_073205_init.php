<?php
/**
 * m180209_073205_init class file.
 */

use app\module\admin\models\Language;
use app\module\admin\models\Module;
use app\module\admin\models\User;

use yii\db\Migration;

/**
 * Class m180209_073205_init
 */
class m180209_073205_init extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        /** Creating tables **/

        $this->createTable('{{%user}}', [
            'user_id' => $this->primaryKey(),
            'username' => $this->string(255)->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string(255)->notNull(),
            'password_reset_token' => $this->string(255)->unique(),
            'email' => $this->string(255)->notNull()->unique(),
            'phone' => $this->string(32)->notNull()->unique(),
            'address' => $this->string(255)->notNull(),
            'role' => 'TINYINT(1) NOT NULL',
            'status' => 'TINYINT(1) NOT NULL',
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
        ], $tableOptions);

        $this->createTable('{{%feedback}}', [
            'feedback_id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'email' => $this->string(255)->notNull(),
            'message' => $this->text()->notNull(),
            'status' => 'TINYINT(1) NOT NULL',
            'created_at' => $this->integer(11)->notNull(),
        ], $tableOptions);

        $this->createTable('{{%language}}', [
            'language_id' => $this->primaryKey(),
            'name' => $this->string(32)->notNull(),
            'code' => $this->string(16)->notNull(),
            'image' => $this->string(255)->notNull(),
            'status' => 'TINYINT(1) NOT NULL',
            'sort_order' => $this->integer(3)->notNull(),
        ], $tableOptions);

        $this->createIndex('name', '{{%language}}', 'name');

        $this->createTable('{{%page}}', [
            'page_id' => $this->primaryKey(),
            'top' => 'TINYINT(1) NOT NULL',
            'bottom' => 'TINYINT(1) NOT NULL',
            'status' => 'TINYINT(1) NOT NULL',
            'sort_order' => $this->integer(3)->notNull(),
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
        ], $tableOptions);

        $this->createTable('{{%page_description}}', [
            'page_id' => $this->integer(11)->notNull(),
            'language_id' => $this->integer(11)->notNull(),
            'title' => $this->string(128)->notNull(),
            'content' => $this->text()->notNull(),
            'meta_title' => $this->string(255)->notNull(),
            'meta_description' => $this->string(255)->notNull(),
            'meta_keyword' => $this->string(255)->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('{{%page_description}}', '{{%page_description}}', ['page_id', 'language_id']);

        $this->createTable('{{%banner}}', [
            'banner_id' => $this->primaryKey(),
            'name' => $this->string(128)->notNull(),
            'status' => 'TINYINT(1) NOT NULL',
        ], $tableOptions);

        $this->createTable('{{%banner_image}}', [
            'banner_image_id' => $this->primaryKey(),
            'banner_id' => $this->integer(11)->notNull(),
            'language_id' => $this->integer(11)->notNull(),
            'title' => $this->string(255)->notNull(),
            'link' => $this->string(255)->notNull(),
            'image' => $this->string(255)->notNull(),
            'sort_order' => $this->integer(3)->notNull(),
        ], $tableOptions);

        $this->createTable('{{%source_message}}', [
            'source_message_id' => $this->primaryKey(),
            'category' => $this->string(255)->notNull(),
            'message' => $this->text()->notNull(),
        ], $tableOptions);

        $this->createIndex('category', '{{%source_message}}', 'category');

        $this->createTable('{{%message}}', [
            'source_message_id' => $this->integer(11)->notNull(),
            'language_id' => $this->integer(11)->notNull(),
            'translation' => $this->text()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('{{%message}}', '{{%message}}', ['source_message_id', 'language_id']);
        $this->createIndex('source_message_id', '{{%message}}', 'source_message_id');
        $this->createIndex('language_id', '{{%message}}', 'language_id');

        $this->createTable('{{%seo_url}}', [
            'seo_url_id' => $this->primaryKey(),
            'language_id' => $this->integer(11)->notNull(),
            'query' => $this->string(255)->notNull(),
            'keyword' => $this->string(255)->notNull(),
        ], $tableOptions);

        $this->createIndex('query', '{{%seo_url}}', 'query');
        $this->createIndex('keyword', '{{%seo_url}}', 'keyword');

        $this->createTable('{{%module}}', [
            'module_id' => $this->primaryKey(),
            'name' => $this->string(32)->notNull(),
            'title' => $this->string(128)->notNull(),
            'author' => $this->string(128)->notNull(),
            'version' => $this->string(32)->notNull(),
            'setting' => $this->text()->notNull(),
            'status' => 'TINYINT(1) NOT NULL',
            'sort_order' => $this->integer(3)->notNull(),
        ], $tableOptions);

        $this->createIndex('name', '{{%module}}', 'name');

        /** Creating admin user **/

        $this->insert('{{%user}}', [
            'username' => 'admin',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->security->generatePasswordHash('admin'),
            'email' => 'admin@devseonetcms.com',
            'phone' => '380683689604',
            'address' => '',
            'role' => User::ROLE_SUPER_ADMIN,
            'status' => User::STATUS_ACTIVE,
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        /** Creating languages **/

        $this->insert('{{%language}}', [
            'name' => 'Russian',
            'code' => 'ru',
            'image' => 'b30ae0308a7afbcd86bf0e02369451c5.png',
            'status' => Language::STATUS_ACTIVE,
            'sort_order' => 1,
        ]);

        $this->insert('{{%language}}', [
            'name' => 'English',
            'code' => 'en',
            'image' => 'e374e07bd99e33f8d4dbe34770be88e2.png',
            'status' => Language::STATUS_ACTIVE,
            'sort_order' => 2,
        ]);

        /** Creating modules */
        $this->insert('{{%module}}', [
            'name' => 'review',
            'title' => 'Отзывы',
            'author' => 'Devseonet',
            'version' => '1.1.0',
            'setting' => '',
            'status' => Module::STATUS_ACTIVE,
            'sort_order' => 1,
        ]);

        $this->insert('{{%module}}', [
            'name' => 'request',
            'title' => 'Заявки',
            'author' => 'Devseonet',
            'version' => '1.0.0',
            'setting' => '',
            'status' => Module::STATUS_ACTIVE,
            'sort_order' => 2,
        ]);

        $this->insert('{{%module}}', [
            'name' => 'faq',
            'title' => 'FAQ',
            'author' => 'Devseonet',
            'version' => '1.0.0',
            'setting' => '',
            'status' => Module::STATUS_ACTIVE,
            'sort_order' => 3,
        ]);

        /** Creating demo data **/
        $this->execute(file_get_contents(__DIR__ . '/init.sql'));
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropIndex('name', '{{%module}}');
        $this->dropTable('{{%module}}');
        $this->dropIndex('keyword', '{{%seo_url}}');
        $this->dropIndex('query', '{{%seo_url}}');
        $this->dropTable('{{%seo_url}}');
        $this->dropIndex('language_id', '{{%message}}');
        $this->dropIndex('source_message_id', '{{%message}}');
        $this->dropPrimaryKey('{{%message}}', '{{%message}}');
        $this->dropTable('{{%message}}');
        $this->dropIndex('category', '{{%source_message}}');
        $this->dropTable('{{%source_message}}');
        $this->dropTable('{{%banner_image}}');
        $this->dropTable('{{%banner}}');
        $this->dropPrimaryKey('{{%page_description}}', '{{%page_description}}');
        $this->dropTable('{{%page_description}}');
        $this->dropTable('{{%page}}');
        $this->dropIndex('name', '{{%language}}');
        $this->dropTable('{{%language}}');
        $this->dropTable('{{%feedback}}');
        $this->dropTable('{{%user}}');
    }
}
