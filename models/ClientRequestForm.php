<?php
/**
 * ClientRequestForm model class file.
 */

namespace app\models;

use Yii;
use app\module\admin\module\request\models\Request;
use yii\base\Model;

/**
 * ClientRequestForm is the model behind the contact form.
 */
class ClientRequestForm extends Model
{
    public $name;
    public $phone;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'phone'], 'required'],
            [['name', 'phone'], 'string', 'max' => 255],
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
        $requestModel->status = Request::STATUS_NEW;

        if ($this->validate() && $requestModel->save()) {
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom($email)
                ->setSubject('Вы получили новую заявку от ' . $this->name . ' (' . $this->phone . ')')
                ->setTextBody('Перейдите в админ-панель для управления заявкой.')
                ->send();

            return true;
        }

        return false;
    }
}
