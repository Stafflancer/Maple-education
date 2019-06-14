<?php
/**
 * LoginForm model class file.
 */

namespace app\module\admin\module\review\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property int $product_id
 * @property string $text
 */
class ReviewForm extends Model
{
    public $product_id;
    public $text;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'text'], 'required'],
            ['product_id', 'integer'],
            ['text', 'string', 'max' => 10000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'text' => Yii::t('review', 'Текст отзыва')
        ];
    }
}
