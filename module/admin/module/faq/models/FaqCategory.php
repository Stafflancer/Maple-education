<?php
/**
 * FaqCategory model class file.
 */

namespace app\module\admin\module\faq\models;

use Yii;
use app\module\admin\models\Language;
use yii\behaviors\TimestampBehavior;
use yii\db\Query;

/**
 * This is the model class for table "tbl_faq_category".
 *
 * @property int $faq_category_id
 * @property int $status
 * @property int $sort_order
 * @property int $created_at
 * @property int $updated_at
 *
 * @property FaqCategoryDescription $faqCategoryDescription
 */
class FaqCategory extends \yii\db\ActiveRecord
{
    const STATUS_NOT_ACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_faq_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'sort_order'], 'required'],
            [['sort_order', 'created_at', 'updated_at'], 'integer'],
            [['status'], 'string', 'max' => 1],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_NOT_ACTIVE, self::STATUS_ACTIVE]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'faq_category_id' => 'ID категории',
            'status' => 'Статус',
            'sort_order' => 'Порядок сортировки',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
            'faqCategoryName' => 'Категория',
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * ActiveRelation to CategoryDescription model.
     *
     * @return \yii\db\ActiveQuery active query instance
     */
    public function getFaqCategoryDescription()
    {
        return $this->hasOne(FaqCategoryDescription::class, ['faq_category_id' => 'faq_category_id'])
            ->andOnCondition(['language_id' => Language::getLanguageIdByCode(Yii::$app->language)]);
    }

    /**
     * Returns category name.
     *
     * @return mixed category name
     */
    public function getFaqCategoryName()
    {
        return $this->faqCategoryDescription->name;
    }

    /**
     * Returns statuses list.
     *
     * @return array statuses list data
     */
    public static function getStatusesList()
    {
        return [
            self::STATUS_ACTIVE => 'Включено',
            self::STATUS_NOT_ACTIVE => 'Отключено'
        ];
    }

    /**
     * Returns status name by specified status constant.
     *
     * @param integer $status status constant
     * @return mixed|string status name
     */
    public static function getStatusName($status)
    {
        $statuses = self::getStatusesList();
        return isset($statuses[$status]) ? $statuses[$status] : 'Неопределено';
    }

    /**
     * Returns faq categories list.
     *
     * @param int $status faq category status to filter. Defaults 'Active'
     * @return array faq categories list
     */
    public static function getList($status = self::STATUS_ACTIVE)
    {
        $result = [];

        $faqCategories = self::getAll($status);

        foreach ($faqCategories as $faqCategory) {
            $result[$faqCategory['faq_category_id']] = $faqCategory['faq_category_name'];
        }

        return $result;
    }

    /**
     * Returns all faq categories.
     *
     * @param int $status faq category status to filter. Defaults 'Active'
     * @return array faq categories data
     */
    public static function getAll($status = self::STATUS_ACTIVE)
    {
        $languageId = Language::getLanguageIdByCode(Yii::$app->language);

        return (new Query())
            ->select(['fc.faq_category_id', 'fcd.name AS faq_category_name', 'fc.status', 'fc.sort_order', 'fc.created_at', 'fc.updated_at'])
            ->from(self::tableName() . ' AS fc')
            ->leftJoin(FaqCategoryDescription::tableName() . ' AS fcd', 'fcd.faq_category_id = fc.faq_category_id')
            ->where(['fcd.language_id' => $languageId, 'fc.status' => $status])
            ->groupBy('fcd.faq_category_id')
            ->orderBy('fc.sort_order ASC')
            ->all();
    }

    /**
     * Returns faq category name by specified faq category id.
     *
     * @param int $faqCategoryId faq category id
     * @return mixed|string language name
     */
    public static function getFaqCategoryNameStatic($faqCategoryId)
    {
        $categories = self::getList();

        return isset($categories[$faqCategoryId]) ? $categories[$faqCategoryId] : 'Неопределено';
    }
}
