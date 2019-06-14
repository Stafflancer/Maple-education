<?php
/**
 * FaqDescription model class file.
 */

namespace app\module\admin\module\faq\models;

use Yii;

/**
 * This is the model class for table "tbl_faq_description".
 *
 * @property int $faq_id
 * @property int $language_id
 * @property string $question
 * @property string $answer
 */
class FaqDescription extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_faq_description';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['faq_id', 'language_id'], 'required'],
            [['question', 'answer'], 'required', 'on' => 'language-is-system'],
            [['faq_id', 'language_id'], 'integer'],
            [['question', 'answer'], 'string'],
            [['faq_id', 'language_id'], 'unique', 'targetAttribute' => ['faq_id', 'language_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'faq_id' => 'ID вопроса',
            'language_id' => 'ID языка',
            'question' => 'Вопрос',
            'answer' => 'Ответ',
        ];
    }

    /**
     * Removes faq  descriptions by faq id.
     *
     * @param string $faqId faq id
     */
    public static function removeByFaqId($faqId)
    {
        self::deleteAll(['faq_id' => $faqId]);
    }
}
