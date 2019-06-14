<?php
/**
 * Review model class file.
 */

namespace app\module\admin\module\review\models;

use Yii;
use app\module\admin\models\BannerImage;
use app\components\ImageBehavior;
use app\module\admin\models\Language;
use Imagine\Image\ManipulatorInterface;
use yii\behaviors\TimestampBehavior;
use yii\db\Query;
use yii\web\UploadedFile;

/**
 * This is the model class for table "tbl_review".
 *
 * @property int $review_id
 * @property int $banner_id
 * @property string $image
 * @property int $status
 * @property int $sort_order
 * @property int $created_at
 * @property int $updated_at
 *
 * @property string $imageFile
 */
class Review extends \yii\db\ActiveRecord
{
    const STATUS_NOT_ACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @var UploadedFile
     */
    public $imageFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_review';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'sort_order'], 'required'],
            [['banner_id', 'status', 'sort_order', 'created_at', 'updated_at'], 'integer'],
            [['image'], 'string', 'max' => 255],
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
            'review_id' => 'ID отзыва',
            'banner_id' => 'Баннер',
            'image' => 'Аватар',
            'imageFile' => 'Аватар',
            'status' => 'Статус',
            'sort_order' => 'Порядок сортировки',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            'image' => [
                'class' => ImageBehavior::class,
                'imageDirectory' => 'review',
            ]
        ];
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
     * Returns image URL.
     *
     * @param string $filename image filename
     * @param int $width image width in pixels
     * @param int $height image height in pixels
     * @param string $mode image resize mode (inset/outset)
     * @param int $quality image quality (0 - 100). Defaults 100.
     * @return null|string image URL
     */
    public static function getImageUrl($filename, $width, $height, $mode = ManipulatorInterface::THUMBNAIL_INSET, $quality = 100)
    {
        return (new self())->resizeImage($filename, $width, $height, $mode, $quality);
    }

    /**
     * Returns all reviews.
     *
     * @param int $status review status to filter. Defaults 'Active'
     * @param null|int $limit reviews limit value
     * @return array reviews data
     */
    public static function getAll($status = self::STATUS_ACTIVE, $limit = null)
    {
        $reviews = [];

        $languageId = Language::getLanguageIdByCode(Yii::$app->language);
        $defaultLanguageId = Language::getLanguageIdByCode(Yii::$app->urlManager->getDefaultLanguage());

        $query = (new Query())
            ->select(['r.review_id', '(CASE WHEN rd.author != "" THEN rd.author ELSE rd2.author END) as author',
                '(CASE WHEN rd.title != "" THEN rd.title ELSE rd2.title END) as title',
                '(CASE WHEN rd.text != "" THEN rd.text ELSE rd2.text END) as text',
                'r.banner_id', 'r.image', 'r.status', 'r.sort_order', 'r.created_at', 'r.updated_at'])
            ->from(self::tableName() . ' AS r')
            ->leftJoin(ReviewDescription::tableName() . ' AS rd', 'r.review_id = rd.review_id AND rd.language_id = '
                . $languageId)
            ->leftJoin(ReviewDescription::tableName() . ' AS rd2', 'r.review_id = rd.review_id AND rd2.language_id = '
                . $defaultLanguageId)
            ->where(['rd.language_id' => $languageId, 'r.status' => $status])
            ->groupBy('rd.review_id')
            ->orderBy('r.sort_order ASC');

        if ($limit) {
            $query->limit($limit);
        }

        $reviewsArray = $query->all();

        foreach ($reviewsArray as $reviewsArrayItem) {
            $images = BannerImage::getAllByBannerIdAndLanguageIdAR($reviewsArrayItem['banner_id'], $languageId);

            if (empty($images)) {
                $images = BannerImage::getAllByBannerIdAndLanguageIdAR($reviewsArrayItem['banner_id'], $defaultLanguageId);
            }

            $reviewsArrayItem['images'] = $images;
            $reviews[] = $reviewsArrayItem;
        }

        return $reviews;
    }

    /**
     * Returns all Review models count.
     *
     * @return int|string Review models count.
     */
    public static function getAllCount()
    {
        return self::find()->count();
    }
}
