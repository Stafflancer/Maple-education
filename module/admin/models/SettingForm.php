<?php
/**
 * SettingForm class file.
 */

namespace app\module\admin\models;

use Yii;
use yii\base\Model;

/**
 * Class SettingForm.
 *
 * @package app\module\admin\models
 */
class SettingForm extends Model
{
    public $siteName;
    public $languageId;
    public $workingHours = [];
    public $address = [];
    public $address2 = [];
    public $liqpay;
    public $visa;
    public $email;
    public $whatsapp;
    public $phones;
    public $phones2;
    public $mainPageId;
    public $mainPageMainBannerId;
    public $mainPageBrandsBannerId;
    public $mainPageShopBannerId;
    public $mainPageCarouselDescr = [];
    public $titlePrefix = [];
    public $titlePostfix = [];
    public $reviewsPageId;
    public $faqPageId;
    public $aboutPageId;
    public $contactsPageId;
    public $productsPageDeliveryDescr = [];
    public $productsPagePaymentDescr = [];
    public $adminEmail;
    public $supportEmail;
    public $mainPageTopic;
    public $mainPageOrientation;
    public $mainPagePlace;
    public $mainPageProgram;
    public $mainPagePayment;
    public $mainPageAppartement;
    public $mainPageConfidence;
    public $mainPageApplication;
    public $mainPageOperations;
    public $mapLat;
    public $mapLng;
    public $mapZoom;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['languageId', 'siteName', 'adminEmail', 'supportEmail'], 'required'],
            [['languageId', 'mainPageId', 'mainPageMainBannerId', 'mainPageBrandsBannerId', 'mainPageShopBannerId',
              'reviewsPageId', 'faqPageId', 'aboutPageId', 'contactsPageId'], 'integer'],
            [['siteName', 'address', 'address2', 'whatsapp', 'phones', 'phones2', 'mapLat', 'mapLng', 'mapZoom'], 'string', 'max' => 255],
            [['email', 'adminEmail', 'supportEmail'], 'email'],
            [['workingHours', 'address', 'address2', 'mainPageCarouselDescr', 'titlePrefix', 'titlePostfix', 'productsPageDeliveryDescr',
                'productsPagePaymentDescr'], 'each', 'rule' => ['string']],
            [['liqpay', 'visa'], 'string', 'max' => 5000],
            [['mainPageTopic', 'mainPageOrientation', 'mainPagePlace', 'mainPageProgram', 'mainPagePayment',
                'mainPageAppartement', 'mainPageConfidence', 'mainPageApplication', 'mainPageOperations'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'siteName' => 'Название сайта',
            'languageId' => 'Язык',
            'workingHours' => 'Режим работы',
            'address' => 'Адрес (Киев)',
            'address2' => 'Адрес (Пекин)',
            'liqpay' => 'LiqPay',
            'visa' => 'Visa',
            'email' => 'Email',
            'whatsapp' => 'WhatsApp',
            'phones' => 'Телефоны (Киев)',
            'phones2' => 'Телефоны (Пекин)',
            'mainPageId' => 'Шаблон',
            'mainPageMainBannerId' => 'Главный слайдер',
            'mainPageBrandsBannerId' => 'Нижняя карусель изображений',
            'mainPageShopBannerId' => 'Банер',
            'mainPageCarouselDescr' => 'Описание в нижней карусели изображений',
            'titlePrefix' => 'Префикс для мета-тега Title',
            'titlePostfix' => 'Постфикс для мета-тега Title',
            'reviewsPageId' => 'Шаблон',
            'faqPageId' => 'Шаблон',
            'aboutPageId' => 'Шаблон',
            'contactsPageId' => 'Шаблон',
            'productsPageDeliveryDescr' => 'Описание доставки',
            'productsPagePaymentDescr' => 'Описание оплаты',
            'adminEmail' => 'Email администратора',
            'supportEmail' => 'Email поддержки',
            'mainPageTopic' => 'Предмет обсуждения',
            'mainPageOrientation' => 'Офис',
            'mainPagePlace' => 'Места работы',
            'mainPageProgram' => 'Программа',
            'mainPagePayment' => 'Стоимость',
            'mainPageAppartement' => 'Жилье',
            'mainPageConfidence' => 'Нам доверяют',
            'mainPageApplication' => 'Приложение',
            'mainPageOperations' => 'Как это работает',
            'mapLat' => 'Широта',
            'mapLng' => 'Долгота',
            'mapZoom' => 'Масштаб',
        ];
    }
}
