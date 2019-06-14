<?php
/**
 * Request model class file.
 */

namespace app\module\admin\module\request\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "tbl_request".
 *
 * @property int $request_id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $education
 * @property string $english_level
 * @property string $birthday_date
 * @property int $status
 * @property int $created_at
 */
class Request extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_PROCESSED = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'phone', 'status'], 'required'],
            [['name', 'phone', 'email', 'education', 'english_level', 'birthday_date'], 'string', 'max' => 255],
            [['status', 'created_at'], 'integer'],
            ['status', 'default', 'value' => self::STATUS_NEW],
            ['status', 'in', 'range' => [self::STATUS_NEW, self::STATUS_PROCESSED]],
            [['email'], 'email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'request_id' => 'ID заявки',
            'name' => 'Имя',
            'phone' => 'Телефон',
            'email' => 'Почтовый адрес',
            'education' => 'Образование',
            'english_level' => 'Уровень английского',
            'birthday_date' => 'Дата рождения',
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
            self::STATUS_NEW => 'Новая',
            self::STATUS_PROCESSED => 'Обработана'
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
     * Returns english levels list.
     *
     * @return array array english levels list data
     */
    public static function getEnglishLevelsList()
    {
        return [
            '' => Yii::t('request-popup', '-- выбрать --'),
           '1' => Yii::t('request-popup', 'Elementary'),
           '2' => Yii::t('request-popup', 'Intermediate'),
           '3' => Yii::t('request-popup', 'Upper Intermediate'),
           '4' => Yii::t('request-popup', 'Advanced'),
           '5' => Yii::t('request-popup', 'Fluent'),
        ];
    }

    /**
     * Returns english level name by specified value.
     *
     * @param integer $value english level value
     * @return mixed|string english level name
     */
    public static function getEnglishLevelName($value)
    {
        $englishLevels = self::getEnglishLevelsList();
        return isset($englishLevels[$value]) ? $englishLevels[$value] : '';
    }

    /**
     * Returns days list.
     *
     * @return array array days list data
     */
    public static function getDaysList()
    {
        $result = [];

        for($i = 1; $i <= 31; $i++) {
            $result[$i] = $i;
        }

        return $result;
    }

    /**
     * Returns months list.
     *
     * @return array array months list data
     */
    public static function getMonthsList()
    {
        return [
            1 => Yii::t('request-popup', 'Январь'),
            2 => Yii::t('request-popup', 'Февраль'),
            3 => Yii::t('request-popup', 'Март'),
            4 => Yii::t('request-popup', 'Апрель'),
            5 => Yii::t('request-popup', 'Май'),
            6 => Yii::t('request-popup', 'Июнь'),
            7 => Yii::t('request-popup', 'Июль'),
            8 => Yii::t('request-popup', 'Август'),
            9 => Yii::t('request-popup', 'Сентябрь'),
            10 => Yii::t('request-popup', 'Октябрь'),
            11 => Yii::t('request-popup', 'Ноябрь'),
            12 => Yii::t('request-popup', 'Декабрь'),
        ];
    }

    /**
     * Returns all Request models count.
     *
     * @return int|string Request models count.
     */
    public static function getAllCount()
    {
        return self::find()->count();
    }

    /**
     * Formats and return date picker template.
     *
     * @return string date picker template
     */
    public static function getDatePickerTemplate()
    {
        $template = "{label}\n<select id=\"date-picker-DatePicker2-day\" class=\"date-picker-control-js\" name=\"\" data-select=\"\" data-date-picker-sel=\"date-picker-DatePicker2\" data-mod=\"select-wrap_date select-wrap_popup\">";

        foreach (self::getDaysList() as $key => $day) {
            $template .= "<option value=\"" . $key . "\">" . $day . "</option>";
        }

        $template .= "</select><select id=\"date-picker-DatePicker2-month\" class=\"date-picker-control-js\" name=\"\" data-select=\"\" data-date-picker-sel=\"date-picker-DatePicker2\" data-mod=\"select-wrap_month select-wrap_popup\">";

        foreach (self::getMonthsList() as $key => $month) {
            $template .= "<option value=\"" . $key . "\">" . $month . "</option>";
        }

        $template .= "</select>";

        $currentYear = (int)date("Y");

        $template .= "<select id=\"date-picker-DatePicker2-year\" class=\"date-picker-control-js\" name=\"\" data-select=\"\" data-date-picker-sel=\"date-picker-DatePicker2\" data-mod=\"select-wrap_year select-wrap_popup\">";

        for ($year = 1980; $year <= $currentYear - 9; $year++) {
            $template .= "<option value=\"" . $year . "\">" . $year . "</option>";
        }

        $template .= "</select>{input}\n{hint}\n{error}";

        return $template;
    }
}
