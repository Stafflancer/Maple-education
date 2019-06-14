<?php
/**
 * FaqCategoryDescription model class file.
 */

namespace app\module\admin\module\faq\models;

use Yii;

/**
 * This is the model class for table "tbl_faq_category_description".
 *
 * @property int $faq_category_id
 * @property int $language_id
 * @property string $name
 */
class FaqCategoryDescription extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_faq_category_description';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['faq_category_id', 'language_id'], 'required'],
            [['name'], 'required', 'on' => 'language-is-system'],
            [['faq_category_id', 'language_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['faq_category_id', 'language_id'], 'unique', 'targetAttribute' => ['faq_category_id', 'language_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'faq_category_id' => 'ID категории',
            'language_id' => 'ID языка',
            'name' => 'Название',
        ];
    }

    /**
     * Removes faq  category descriptions by faq category id.
     *
     * @param string $faqCategoryId faq category id
     */
    public static function removeByFaqCategoryId($faqCategoryId)
    {
        self::deleteAll(['faq_category_id' => $faqCategoryId]);
    }
}
