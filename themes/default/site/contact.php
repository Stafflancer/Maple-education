<?php
/**
 * Contact page view.
 */

/* @var $this yii\web\View */
/* @var $page array */
/* @var $defaultPage array */
/* @var $address string */
/* @var $email string */
/* @var $phones array */
/* @var $contactsMapSrc string */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\ContactForm */

use app\module\admin\models\Language;
use app\widgets\ClientRequestPopup;
use yii\web\View;

$this->params['bodyClass'] = 'no-touch is-animate';

$languageId = Language::getLanguageIdByCode(Yii::$app->language);
$defaultLanguageId = Language::getLanguageIdByCode(Yii::$app->urlManager->getDefaultLanguage());

$this->title = $page['meta_title'] ? $page['meta_title'] : $defaultPage['meta_title'];

$metaDescription = $page['meta_description'] ? $page['meta_description'] : $defaultPage['meta_description'];
$metaKeywords = $page['meta_keyword'] ? $page['meta_keyword'] : $defaultPage['meta_keyword'];

if ($metaDescription) {
    $this->registerMetaTag([
        'name' => 'description',
        'content' => $metaDescription,
    ]);
}
if ($metaKeywords) {
    $this->registerMetaTag([
        'name' => 'keywords',
        'content' => $metaKeywords,
    ]);
}

$siteName = isset(Yii::$app->params['siteName']) ? Yii::$app->params['siteName'] : '';
$email = isset(Yii::$app->params['email']) ? Yii::$app->params['email'] : null;
$whatsapp = isset(Yii::$app->params['whatsapp']) ? Yii::$app->params['whatsapp'] : null;
$phones = isset(Yii::$app->params['phones']) ? explode(PHP_EOL, Yii::$app->params['phones']) : null;
$phones2 = isset(Yii::$app->params['phones2']) ? explode(PHP_EOL, Yii::$app->params['phones2']) : null;
$liqpay = isset(Yii::$app->params['liqpay']) ? Yii::$app->params['liqpay'] : null;
$visa = isset(Yii::$app->params['visa']) ? Yii::$app->params['visa'] : null;
$address = !empty(Yii::$app->params['address'][$languageId]) ? Yii::$app->params['address'][$languageId]
    : (!empty(Yii::$app->params['address'][$defaultLanguageId]) ? Yii::$app->params['address'][$defaultLanguageId] : '');
$address2 = !empty(Yii::$app->params['address2'][$languageId]) ? Yii::$app->params['address2'][$languageId]
    : (!empty(Yii::$app->params['address2'][$defaultLanguageId]) ? Yii::$app->params['address2'][$defaultLanguageId] : '');
$workingHours = !empty(Yii::$app->params['workingHours'][$languageId]) ? Yii::$app->params['workingHours'][$languageId]
    : (!empty(Yii::$app->params['workingHours'][$defaultLanguageId]) ? Yii::$app->params['workingHours'][$defaultLanguageId] : '');

$mapLat = isset(Yii::$app->params['mapLat']) ? Yii::$app->params['mapLat'] : '';
$mapLng = isset(Yii::$app->params['mapLng']) ? Yii::$app->params['mapLng'] : '';
$mapZoom = isset(Yii::$app->params['mapZoom']) ? Yii::$app->params['mapZoom'] : '';

?>
<div class="contacts" data-section="contacts" data-anim="group">
    <div class="buble-img" data-anim="group-parent"><img src="/static/img/contacts-bubles/1.png" alt="" data-anim="stagger-element"></div>
    <div class="contacts__in inner inner_mob">
        <div class="contacts__left" data-anim="group-parent">
            <h2 class="title-h2 title-h2_line contacts__title " data-anim="stagger-items"> <?= Yii::t('contacts', 'Ждём вас в гости') ?> </h2>
            <?php if (!empty($address)): ?>
            <div class="contacts__col" data-anim="group-parent"><h4 class="sub-title" data-anim="stagger-items"> <?= Yii::t('footer', 'Киев') ?>: </h4>
                <div class="contacts__item">
                    <div data-anim="stagger-items"> <?= $address ?></div>
                </div>
                <div class="contacts__item">
                    <?php if (!empty($phones[0])): ?>
                    <p data-anim="stagger-items"> <?= $phones[0] ?> </p>
                    <?php endif; ?>
                    <?php if (!empty($phones[1])): ?>
                    <p data-anim="stagger-items"> <?= $phones[1] ?> </p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
            <?php if (!empty($address2)): ?>
            <div class="contacts__col" data-anim="group-parent"><h4 class="sub-title" data-anim="stagger-items"> <?= Yii::t('footer', 'Пекин') ?>: </h4>
                <div class="contacts__item">
                    <div data-anim="stagger-items"> <?= $address2 ?></div>
                </div>
                <div class="contacts__item">
                    <?php if (!empty($phones2[0])): ?>
                    <div class="stagger-items"> <?= $phones2[0] ?> </div>
                    <?php endif; ?>
                    <?php if (!empty($phones2[1])): ?>
                    <div class="stagger-items"> <?= $phones2[1] ?> </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <div class="contacts__right contacts__bottom " data-anim="group-parent">
            <h2 class="title-h2 title-h2_line contacts__title" data-anim="stagger-element"> <?= Yii::t('contacts', 'Режим работы') ?> </h2>
            <div class="contacts__col">
                <div class="contacts__row" data-anim="stagger-element">
                    <?= $workingHours ?>
                </div>
            </div>
        </div>
        <div class="contacts__more contacts__left contacts__bottom " data-anim="group-parent">
            <h2 class="title-h2 title-h2_line contacts__title" data-anim="stagger-element" data-anim-element-delay="0.4"> <?= Yii::t('contacts', 'Доп. контакты') ?> </h2>
            <?php if (!empty($email)): ?>
            <div class="contacts__row contacts__item">
                <h4 class="sub-title" data-anim="stagger-element"> <?= Yii::t('footer', 'Почта') ?> </h4>
                <p data-anim="stagger-element"> <?= $email ?> </p>
            </div>
            <?php endif; ?>
            <?php if (!empty($whatsapp)): ?>
            <div class="contacts__row contacts__item">
                <h4 class="sub-title" data-anim="stagger-element"> <?= Yii::t('footer', 'WhatsApp') ?>: </h4>
                <p data-anim="stagger-element"> <?= $whatsapp ?> </p>
            </div>
            <?php endif; ?>
        </div>
        <div class="contacts__map " data-anim="group-parent">
            <svg version="1.1" class="map-over" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 646 646" style="enable-background:new 0 0 645 645;" xml:space="preserve"><defs><filter id="Adobe_OpacityMaskFilter" filterUnits="userSpaceOnUse" x="0" y="0" width="646" height="646"><feColorMatrix type="matrix" values="1 0 0 0 0 0 1 0 0 0 0 0 1 0 0 0 0 0 1 0"/></filter></defs><mask maskUnits="userSpaceOnUse" x="0" y="0" width="646" height="646" id="SVGID_1_"><g style="filter:url(#Adobe_OpacityMaskFilter);"></g></mask><circle style="mask:url(#SVGID_1_);fill:#FFFFFF;stroke:#000000;stroke-miterlimit:10;" cx="323" cy="323" r="322.5"/></svg>
            <div class="map js-map" data-anim="stagger-element" data-anim-element-delay="1" id="contact-map" data-center-lat="<?= $mapLat ?>" data-center-lng="<?= $mapLng ?>" data-zoom="<?= $mapZoom ?>" data-marker-img="/img/marker.png" data-src="/static/json/map-styles.json" data-aos="fade" data-aos-delay="0"></div>
        </div>
    </div>
    <div class="buble-img buble-img_bot" data-anim="group-parent"><img src="/static/img/contacts-bubles/2.png" alt="alt" data-anim="stagger-element"></div>
</div>
<?= ClientRequestPopup::widget() ?>
<?php
$this->registerJsFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyAZdPBB1aSlGzoM6b9WrkEUgo-gTfnO_AM', ['position' => View::POS_END], 'google-maps-api'); ?>
