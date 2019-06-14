<?php
/**
 * ReviewDescription model class file.
 */

namespace app\module\admin\module\review\models;

/**
 * This is the model class for table "{{%review_description}}".
 *
 * @property int $review_id
 * @property int $language_id
 * @property string $author
 * @property string $title
 * @property string $text
 */
class ReviewDescription extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%review_description}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['review_id', 'language_id'], 'required'],
            [['author', 'title'], 'required', 'on' => 'language-is-system'],
            [['review_id', 'language_id'], 'integer'],
            [['text'], 'string'],
            [['author', 'title'], 'string', 'max' => 255],
            [['review_id', 'language_id'], 'unique', 'targetAttribute' => ['review_id', 'language_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'review_id' => 'ID отзыва',
            'language_id' => 'ID языка',
            'author' => 'Автор',
            'title' => 'Заголовок',
            'text' => 'Содержание отзыва',
        ];
    }

    /**
     * Removes review descriptions by review id.
     *
     * @param string $reviewId review id
     */
    public static function removeByReviewId($reviewId)
    {
        self::deleteAll(['review_id' => $reviewId]);
    }
}
