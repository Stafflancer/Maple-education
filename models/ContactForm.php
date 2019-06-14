<?php
/**
 * ContactForm model class file.
 */

namespace app\models;

use app\module\admin\models\Feedback;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $message;
    public $verifyCode;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'message'], 'required'],
            [['email'], 'email'],

        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('faq', 'Имя'),
            'email' => Yii::t('faq', 'Почтовый адрес'),
            'message' => Yii::t('faq', 'Напишите свой вопрос здесь'),
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function contact($email)
    {
        $feedbackModel = new Feedback();

        $feedbackModel->name = $this->name;
        $feedbackModel->email = $this->email;
        $feedbackModel->message = $this->message;
        $feedbackModel->status = Feedback::STATUS_NEW;

        if ($this->validate() && $feedbackModel->save()) {
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom($email)
                ->setSubject('Новое сообщение обратной связи от ' . $this->name . ' (' . $this->email . ')')
                ->setTextBody($this->message)
                ->send();

            return true;
        }

        return false;
    }
}
