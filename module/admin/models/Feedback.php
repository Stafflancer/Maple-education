<?php
/**
 * Feedback model class file.
 */

namespace app\module\admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%feedback}}".
 *
 * @property int $feedback_id
 * @property string $name
 * @property string $email
 * @property string $message
 * @property int $status
 * @property int $created_at
 */
class Feedback extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_PROCESSED = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%feedback}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'message', 'status'], 'required'],
            [['status', 'created_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['email'], 'email'],
            [['message'], 'string', 'max' => 5000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'feedback_id' => 'ID сообщения',
            'name' => 'Имя',
            'email' => 'Почтовый адрес',
            'message' => 'Вопрос',
            'status' => 'Статус',
            'created_at' => 'Создано',
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp'  => [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false,
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
            self::STATUS_NEW => 'Новое сообщение',
            self::STATUS_PROCESSED => 'Обработанное сообщение'
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
     * Returns all Feedback models count.
     *
     * @return int|string Feedback models count.
     */
    public static function getAllCount()
    {
        return self::find()->count();
    }
}
