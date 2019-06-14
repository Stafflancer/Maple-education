<?php
/**
 * m180228_084327_messages class file.
 */

use app\module\admin\models\SourceMessage;
use yii\db\Migration;

/**
 * Class m180228_084327_messages
 */
class m180228_084327_messages extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->insert('{{%source_message}}', [
            'category' => 'header',
            'message' => 'ме',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'ме',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'me',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'header',
            'message' => 'назад',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'назад',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'back',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'header',
            'message' => 'ню',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'ню',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'nu',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'header',
            'message' => 'заявка',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'заявка',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'apply',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'header',
            'message' => 'оставить заявку',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'оставить заявку',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'apply',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'footer',
            'message' => 'Меню',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Меню',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Menu',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'footer',
            'message' => 'Телефон',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Телефон',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Phone',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'footer',
            'message' => 'Киев',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Киев',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Kiev',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'footer',
            'message' => 'Пекин',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Пекин',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Beijing',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'footer',
            'message' => 'WhatsApp',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'WhatsApp',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'WhatsApp',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'footer',
            'message' => 'Почта',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Почта',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'E-mail',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'footer',
            'message' => 'Принимаем платежи',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Принимаем платежи',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Accept Payments',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'footer',
            'message' => 'Офис',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Офис',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Office',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'main',
            'message' => 'Места работы',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Места работы',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Places of work',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'main',
            'message' => 'Стоимость',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Стоимость',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Program cost',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'main',
            'message' => 'Жилье',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Жилье',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Accommodation',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'main',
            'message' => 'Нам доверяют',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Нам доверяют',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'We are trusted',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'main',
            'message' => 'Приложение ESL',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Приложение ESL',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'ESL Application',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'main',
            'message' => 'Отзывы',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Отзывы',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Testimonials',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'main',
            'message' => 'Как это работает',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Как это работает',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'How it works',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'main',
            'message' => 'Отправить заявку',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Отправить заявку',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Send request',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'main',
            'message' => 'Вниз',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Вниз',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Down',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'error',
            'message' => 'Oops! Запрошенная страница не найдена, перейти',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Oops! Запрошенная страница не найдена, перейти',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Oops! The requested page not found, go to',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'error',
            'message' => 'на главную',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'на главную',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'home',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'contacts',
            'message' => 'Ждём вас в гости',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Ждём вас в гости',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Welcome to visit',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'contacts',
            'message' => 'Режим работы',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Режим работы',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Working Hours',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'contacts',
            'message' => 'Доп. контакты',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Доп. контакты',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Additional contacts',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'about',
            'message' => 'Отзывы от наших клиентов-учителей из Китая',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Отзывы от наших клиентов-учителей из Китая',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Feedback from our ESL teachers',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'about',
            'message' => 'все отзывы',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'все отзывы',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'see all reviews',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'reviews',
            'message' => 'Наши клиенты, которые живут и работают учителями в Китае',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Наши клиенты, которые живут и работают учителями в Китае',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Our clients, who live and work as ESL teachers in China',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'reviews',
            'message' => 'По просьбе клиентов, личные контакты скрыты от публичного просмотра',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'По просьбе клиентов, личные контакты скрыты от публичного просмотра',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'At the request of customers, personal contacts are hidden from public view',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'reviews',
            'message' => 'назад',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'назад',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'prev',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'reviews',
            'message' => 'вперед',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'вперед',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'next',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'about',
            'message' => 'Есть вопросы о переезде, работе или жизни в Китае?',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Есть вопросы о переезде, работе или жизни в Китае?',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Got a question?',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'about',
            'message' => 'Задать вопрос',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Задать вопрос',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Find answers',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'faq',
            'message' => 'Здесь мы отобрали часто задаваемые вопросы и ответили на них',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Здесь мы отобрали часто задаваемые вопросы и ответили на них',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Frequently asked questions:',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'main',
            'message' => 'Что говорят о нас клиенты',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Что говорят о нас клиенты',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'What our people say',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'faq',
            'message' => 'Не нашли вопрос?',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Не нашли вопрос?',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Haven’t found your question?',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'faq',
            'message' => 'Ваш вопрос успешно отправлен',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Ваш вопрос успешно отправлен',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'The form was successfully send',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'faq',
            'message' => 'Спасибо!',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Спасибо!',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Thanks!',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'faq',
            'message' => 'Напишите его и мы ответим',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Напишите его и мы ответим',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Write it and we will reply',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'faq',
            'message' => 'Отправить вопрос',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Отправить вопрос',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Send',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'faq',
            'message' => 'Спасибо вам!',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Спасибо вам!',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Thank you!',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'faq',
            'message' => 'Имя',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Имя',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Name',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'faq',
            'message' => 'Почтовый адрес',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Почтовый адрес',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'E-mail',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'faq',
            'message' => 'Напишите свой вопрос здесь',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Напишите свой вопрос здесь',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Type your question here',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'request-popup',
            'message' => 'Имя',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Имя',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Name',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'request-popup',
            'message' => 'Телефон',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Телефон',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Phone',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'request-popup',
            'message' => 'Почтовый адрес',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Почтовый адрес',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'E-mail',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'request-popup',
            'message' => 'Образование',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Образование',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Education',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'request-popup',
            'message' => 'Уровень английского',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Уровень английского',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'English level',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'request-popup',
            'message' => 'Дата рождения',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Дата рождения',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Birthday date',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'main',
            'message' => 'Оставьте заявку и мы вместе сделаем первый шаг',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Оставьте заявку и мы вместе сделаем первый шаг',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Apply for ESL Global now and we’ll kindly help you to make the first step:',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'main',
            'message' => 'Вышлем примеры резюме </br>и поможем в его составлении',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Вышлем примеры резюме </br>и поможем в его составлении',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'As easy as follows',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'main',
            'message' => 'Оставить заявку',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Оставить заявку',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Apply',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'request-popup',
            'message' => 'НАЗАД!',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'НАЗАД!',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'BACK',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'request-popup',
            'message' => 'Отправьте заявку и мы перезвоним.',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Отправьте заявку и мы перезвоним.',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Send the request and we will call back.',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'request-popup',
            'message' => 'Познакомимся, расскажем детальнее о программе, а также ответим на ваши вопросы.',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Познакомимся, расскажем детальнее о программе, а также ответим на ваши вопросы.',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Let\'s get acquainted, tell us more about the program, and also answer your questions.',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'request-popup',
            'message' => '-- выбрать --',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => '-- выбрать --',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => '-- select --',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'request-popup',
            'message' => 'Elementary',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Elementary',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Elementary',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'request-popup',
            'message' => 'Intermediate',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Intermediate',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Intermediate',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'request-popup',
            'message' => 'Upper Intermediate',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Upper Intermediate',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Upper Intermediate',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'request-popup',
            'message' => 'Advanced',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Advanced',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Advanced',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'request-popup',
            'message' => 'Fluent',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Fluent',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'Fluent',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'request-popup',
            'message' => 'Январь',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Январь',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'January',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'request-popup',
            'message' => 'Февраль',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Февраль',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'February',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'request-popup',
            'message' => 'Март',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Март',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'March',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'request-popup',
            'message' => 'Апрель',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Апрель',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'April',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'request-popup',
            'message' => 'Май',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Май',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'May',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'request-popup',
            'message' => 'Июнь',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Июнь',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'June',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'request-popup',
            'message' => 'Июль',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Июль',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'July',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'request-popup',
            'message' => 'Август',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Август',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'August',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'request-popup',
            'message' => 'Сентябрь',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Сентябрь',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'September',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'request-popup',
            'message' => 'Октябрь',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Октябрь',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'October',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'request-popup',
            'message' => 'Ноябрь',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Ноябрь',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'November',
        ]);

        $this->insert('{{%source_message}}', [
            'category' => 'request-popup',
            'message' => 'Декабрь',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 1,
            'translation' => 'Декабрь',
        ]);

        $this->insert('{{%message}}', [
            'source_message_id' => SourceMessage::getLastId(),
            'language_id' => 2,
            'translation' => 'December',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->truncateTable('{{%message}}');
        $this->truncateTable('{{%source_message}}');
    }
}
