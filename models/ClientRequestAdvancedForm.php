<?php
/**
 * ClientRequestAdvancedForm model class file.
 */

namespace app\models;

use Yii;
use app\module\admin\module\request\models\Request;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ClientRequestAdvancedForm extends Model
{
    public $name;
    public $phone;
    public $email;
    public $education;
    public $english_level;
    public $birthday_date;

    public $date;
    public $month;
    public $year;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'phone', 'email', 'education', 'english_level', 'birthday_date'], 'required'],
            [['name', 'phone', 'email', 'education', 'english_level', 'birthday_date', 'date', 'month', 'year'], 'string', 'max' => 255],
            [['email'], 'email'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('request-popup', 'Имя'),
            'phone' => Yii::t('request-popup', 'Телефон'),
            'email' => Yii::t('request-popup', 'Почтовый адрес'),
            'education' => Yii::t('request-popup', 'Образование'),
            'english_level' => Yii::t('request-popup', 'Уровень английского'),
            'birthday_date' => Yii::t('request-popup', 'Дата рождения'),
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function send($email)
    {
        $requestModel = new Request();

        $requestModel->name = $this->name;
        $requestModel->phone = $this->phone;
        $requestModel->email = $this->email;
        $requestModel->education = $this->education;
        $requestModel->english_level = Request::getEnglishLevelName($this->english_level);
        $requestModel->birthday_date = $this->birthday_date;
        $requestModel->status = Request::STATUS_NEW;

        $body = '<p><strong>Имя:</strong> ' . $requestModel->name . '</p>';
        $body .= '<p><strong>Телефон:</strong> ' . $requestModel->phone . '</p>';
        $body .= '<p><strong>Почтовый адрес:</strong> ' . $requestModel->email . '</p>';
        $body .= '<p><strong>Образование:</strong> ' . $requestModel->education . '</p>';
        $body .= '<p><strong>Уровень английского:</strong> ' . $requestModel->english_level . '</p>';
        $body .= '<p><strong>Дата рождения:</strong> ' . $requestModel->birthday_date . '</p>';
        $body .= '<p><strong>Статус:</strong> ' . Request::getStatusName($requestModel->status) . '</p>';

        if ($this->validate() && $requestModel->save()) {
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom($email)
                ->setSubject('Вы получили новую заявку от ' . $this->name . ' (' . $this->email . ')')
                ->setHtmlBody($body)
                ->send();

            return true;
        }

        return false;
    }
}
