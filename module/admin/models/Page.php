<?php
/**
 * Page model class file.
 */

namespace app\module\admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Query;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%page}}".
 *
 * @property int $page_id
 * @property int $top
 * @property int $bottom
 * @property int $status
 * @property int $sort_order
 * @property int $created_at
 * @property int $updated_at
 *
 * @property $pageDescription
 */
class Page extends \yii\db\ActiveRecord
{
    const STATUS_NOT_ACTIVE = 0;
    const STATUS_ACTIVE = 1;

    const TOP_NO = 0;
    const TOP_YES = 1;

    const BOTTOM_NO = 0;
    const BOTTOM_YES = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['top', 'bottom', 'status', 'sort_order'], 'required'],
            [['top', 'bottom', 'status', 'sort_order'], 'integer'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_NOT_ACTIVE, self::STATUS_ACTIVE]],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'page_id' => 'ID страницы',
            'top' => 'Показывать в главном меню',
            'bottom' => 'Показывать в футере',
            'status' => 'Статус',
            'sort_order' => 'Порядок сортировки',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
            'pageName' => 'Название'
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
     * ActiveRelation to PageDescription model.
     *
     * @return \yii\db\ActiveQuery active query instance
     */
    public function getPageDescription()
    {
        return $this->hasOne(PageDescription::class, ['page_id' => 'page_id'])
            ->andOnCondition(['language_id' => Language::getLanguageIdByCode(Yii::$app->language)]);
    }

    /**
     * Returns page name.
     *
     * @return mixed page name
     */
    public function getPageName()
    {
        return $this->pageDescription->title;
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
     * Returns page title by specified page id and language id.
     *
     * @param int $pageId page id
     * @param int $languageId language id
     * @return false|null|string page title
     */
    public static function geTitleById($pageId, $languageId)
    {
        return (new Query())
            ->select(['title'])
            ->from(PageDescription::tableName())
            ->where(['page_id' => $pageId, 'language_id' => $languageId])
            ->scalar();
    }

    /**
     * Returns page by language id.
     *
     * @param int $id page id
     * @param int $languageId language id
     * @return array page
     */
    public static function getByIdAndLanguageId($id, $languageId)
    {
        return (new Query())
            ->select(['p.page_id', 'pd.title AS title', 'pd.content as content',
                '(CASE WHEN pd.meta_title IS NULL OR pd.meta_title = "" THEN pd.title ELSE pd.meta_title END) AS meta_title',
                'pd.meta_description as meta_description', 'pd.meta_keyword as meta_keyword', 'p.top', 'p.bottom', 'p.status',
                'p.sort_order', 'p.created_at', 'p.updated_at'
            ])
            ->from(self::tableName() . ' AS p')
            ->leftJoin(PageDescription::tableName() . ' AS pd', 'pd.page_id = p.page_id')
            ->where(['p.page_id' => $id, 'language_id' => $languageId])
            ->groupBy('pd.page_id')
            ->one();
    }

    /**
     * Returns all pages.
     *
     * @param int $status page status to filter. Defaults 'Active'
     * @return array pages data
     */
    public static function getAll($status = self::STATUS_ACTIVE)
    {
        $languageId = Language::getLanguageIdByCode(Yii::$app->language);

        return (new Query())
            ->select(['p.page_id', 'pd.title AS page_title', 'p.top', 'p.bottom', 'p.status', 'p.sort_order', 'p.created_at', 'p.updated_at'])
            ->from(self::tableName() . ' AS p')
            ->leftJoin(PageDescription::tableName() . ' AS pd', 'pd.page_id = p.page_id')
            ->where(['pd.language_id' => $languageId, 'p.status' => $status])
            ->groupBy('pd.page_id')
            ->orderBy('p.sort_order ASC')
            ->all();
    }

    /**
     * Returns pages list.
     *
     * @param int $status page status to filter. Defaults 'Active'
     * @return array gapes list
     */
    public static function getList($status = self::STATUS_ACTIVE)
    {
        $result = [];

        $pages = self::getAll($status);

        foreach ($pages as $page) {
            $result[$page['page_id']] = $page['page_title'];
        }

        return $result;
    }

    /**
     * Returns main menu items list.
     *
     * @param int $languageId language id
     * @param bool $bottom true to get bottom menu items, false - to get top menu items
     * @return array menu items
     */
    public static function getMenuItems($languageId, $bottom = false)
    {
        $result = [];

        $query = (new Query())
            ->select(['p.page_id', 'pd.title AS page_title', 'su.keyword AS page_url', 'p.top', 'p.bottom', 'p.status', 'p.sort_order', 'p.created_at', 'p.updated_at'])
            ->from(self::tableName() . ' AS p')
            ->leftJoin(PageDescription::tableName() . ' AS pd', 'pd.page_id = p.page_id')
            ->leftJoin(SeoUrl::tableName() . ' AS su', "su.query = CONCAT('page_id=', pd.page_id)")
            ->where([
                'pd.language_id' => $languageId,
                'su.language_id' => $languageId,
                'p.status' => self::STATUS_ACTIVE,
            ]);

        if ($bottom) {
            $query->andWhere(['p.bottom' => self::BOTTOM_YES]);
        } else {
            $query->andWhere(['p.top' => self::TOP_YES]);
        }

        $pages = $query->groupBy('pd.page_id, page_url')
            ->orderBy('p.sort_order ASC')
            ->all();

        foreach ($pages as $page) {
            $url = Url::to(['/' . $page['page_url']]);

            $result[$page['page_id']] = [
                'title' => $page['page_title'],
                'href' => $url,
                'active' => self::isMenuItemActive($url),
            ];
        }

        return $result;
    }

    /**
     * Checks whether menu item is active or not.
     *
     * @param string $url menu item URL
     * @return bool whether menu item is active or not
     */
    public static function isMenuItemActive($url)
    {
        return (trim(Yii::$app->request->url, '/') == trim($url, '/'));
    }

    /**
     * Returns all Page models count.
     *
     * @return int|string Page models count.
     */
    public static function getAllCount()
    {
        return self::find()->count();
    }

    /**
     * Returns last inserted
     * @return false|null|string
     */
    public static function getLastId()
    {
        return (new Query())
            ->select('page_id')
            ->from(self::tableName())
            ->orderBy('page_id DESC')
            ->limit(1)
            ->scalar();
    }
}
