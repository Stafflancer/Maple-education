<?php
/**
 * Banner model class file.
 */

namespace app\module\admin\models;

use app\components\ImageBehavior;

use yii\db\Query;

/**
 * This is the model class for table "{{%banner}}".
 *
 * @property int $banner_id
 * @property string $name
 * @property int $status
 */
class Banner extends \yii\db\ActiveRecord
{
    const STATUS_NOT_ACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%banner}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'status'], 'required'],
            [['status'], 'integer'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_NOT_ACTIVE, self::STATUS_ACTIVE]],
            [['name'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'banner_id' => 'ID баннера',
            'name' => 'Название',
            'status' => 'Статус',
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'image' => [
                'class' => ImageBehavior::class,
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
     * Returns all banners.
     *
     * @param int $status banner status to filter. Defaults 'Active'
     * @return array banners data
     */
    public static function getAll($status = self::STATUS_ACTIVE)
    {
        return (new Query())
            ->select(['banner_id', 'name', 'status'])
            ->from(self::tableName())
            ->where(['status' => $status])
            ->all();
    }

    /**
     * Returns banners list.
     *
     * @param int $status banner status to filter. Defaults 'Active'
     * @return array banners list
     */
    public static function getList($status = self::STATUS_ACTIVE)
    {
        $result = [];

        $banners = self::getAll($status);

        foreach ($banners as $banner) {
            $result[$banner['banner_id']] = $banner['name'];
        }

        return $result;
    }

    /**
     * Returns banner by banner id.
     *
     * @param int $bannerId banner id
     * @param int $status banner status to filter. Defaults 'Active'
     * @return array banner data
     */
    public static function getByBannerId($bannerId, $status = self::STATUS_ACTIVE)
    {
        return (new Query())
            ->select(['banner_id', 'name', 'status'])
            ->from(self::tableName() . ' AS p')
            ->where(['banner_id' => $bannerId, 'status' => $status])
            ->one();
    }
}
