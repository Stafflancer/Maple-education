<?php
/**
 * Faq model class file.
 */

namespace app\module\admin\module\faq\models;

use Yii;
use app\module\admin\models\Language;
use yii\behaviors\TimestampBehavior;
use yii\db\Query;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "tbl_faq".
 *
 * @property int $faq_id
 * @property int $faq_category_id
 * @property int $status
 * @property int $sort_order
 * @property int $created_at
 * @property int $updated_at
 *
 * @property FaqDescription $faqDescription
 */
class Faq extends \yii\db\ActiveRecord
{
    const STATUS_NOT_ACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_faq';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['faq_category_id', 'status', 'sort_order'], 'required'],
            [['faq_category_id', 'sort_order', 'created_at', 'updated_at'], 'integer'],
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
            'faq_id' => 'ID вопроса',
            'faq_category_id' => 'Категория',
            'status' => 'Статус',
            'sort_order' => 'Порядок сортировки',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
            'faqQuestion' => 'Вопрос',
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
     * Removes faq by faq category id.
     *
     * @param string $faqCategoryId order id
     */
    public static function removeByFaqCategoryId($faqCategoryId)
    {
        self::deleteAll(['faq_category_id' => $faqCategoryId]);
    }

    /**
     * ActiveRelation to FaqDescription model.
     *
     * @return \yii\db\ActiveQuery active query instance
     */
    public function getFaqDescription()
    {
        return $this->hasOne(FaqDescription::class, ['faq_id' => 'faq_id'])
            ->andOnCondition(['language_id' => Language::getLanguageIdByCode(Yii::$app->language)]);
    }

    /**
     * Returns question.
     *
     * @return mixed question
     */
    public function getFaqQuestion()
    {
        return $this->faqDescription->question;
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
     * Returns all faq's.
     *
     * @param int $status faq status to filtef. Defaults 'Active'
     * @param null|int $limit faq's limit value
     * @return array faq's data
     */
    public static function getAll($status = self::STATUS_ACTIVE, $limit = null)
    {
        $result = [];

        $languageId = Language::getLanguageIdByCode(Yii::$app->language);
        $defaultLanguageId = Language::getLanguageIdByCode(Yii::$app->urlManager->getDefaultLanguage());

        $faqCategories = (new Query())
            ->select(['fc.faq_category_id', '(CASE WHEN fcd.name != "" THEN fcd.name ELSE fcd2.name END) as name',
                'fc.status', 'fc.sort_order', 'fc.created_at', 'fc.updated_at'])
            ->from(FaqCategory::tableName() . ' AS fc')
            ->leftJoin(FaqCategoryDescription::tableName() . ' AS fcd', 'fc.faq_category_id = fcd.faq_category_id AND fcd.language_id = '
                . $languageId)
            ->leftJoin(FaqCategoryDescription::tableName() . ' AS fcd2', 'fc.faq_category_id = fcd2.faq_category_id AND fcd2.language_id = '
                . $defaultLanguageId)
            ->where(['fcd.language_id' => $languageId, 'fc.status' => $status])
            ->groupBy('fcd.faq_category_id')
            ->orderBy('fc.sort_order ASC')
            ->all();

        foreach ($faqCategories as $faqCategory) {
            $faq = (new Query())
                ->select(['f.faq_id', 'f.faq_category_id', '(CASE WHEN fd.question != "" THEN fd.question ELSE fd2.question END) as question',
                    '(CASE WHEN fd.answer != "" THEN fd.answer ELSE fd2.answer END) as answer',
                    'f.status', 'f.sort_order', 'f.created_at', 'f.updated_at'])
                ->from(self::tableName() . ' AS f')
                ->leftJoin(FaqDescription::tableName() . ' AS fd', 'f.faq_id = fd.faq_id AND fd.language_id = '
                    . $languageId)
                ->leftJoin(FaqDescription::tableName() . ' AS fd2', 'f.faq_id = fd.faq_id AND fd2.language_id = '
                    . $defaultLanguageId)
                ->where([
                    'f.faq_category_id' => $faqCategory['faq_category_id'],
                    'fd.language_id' => $languageId,
                    'f.status' => $status
                ])
                ->groupBy('fd.faq_id')
                ->orderBy('f.sort_order ASC')
                ->all();

            $faqCategory['faq'] = $faq;

            $result[] = $faqCategory;
        }

        return $result;
    }

    /**
     * Returns all Faq models count.
     *
     * @return int|string Faq models count.
     */
    public static function getAllCount()
    {
        return self::find()->count();
    }
}
