<?php

namespace app\module\admin\module\faq\models;

use Yii;

/**
 * This is the model class for table "tbl_faq_to_category".
 *
 * @property int $faq_id
 * @property int $faq_category_id
 */
class FaqToCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_faq_to_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['faq_id', 'faq_category_id'], 'required'],
            [['faq_id', 'faq_category_id'], 'integer'],
            [['faq_id', 'faq_category_id'], 'unique', 'targetAttribute' => ['faq_id', 'faq_category_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'faq_id' => 'Faq ID',
            'faq_category_id' => 'Faq Category ID',
        ];
    }
}
