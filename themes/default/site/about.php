<?php
/**
 * About page view.
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
/* @var $reviews array */

use app\module\admin\models\Language;
use app\module\admin\module\review\models\Review;
use app\widgets\ClientRequestPopup;
use yii\helpers\Url;

$this->params['bodyClass'] = '';

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

?>
<div class="about">
    <?php
    if (!empty($page['content'])) {
        echo $page['content'];
    } else {
        $defaultPage['content'];
    }
    ?>
    <?php if (!empty($reviews)): ?>
    <div class="comments" id="comments" data-anim="group" data-section="">
        <div class="buble-img" data-anim="stagger-element"><img src="<?= Url::to('/static/img/about-bubles/7.png') ?>" alt=""></div>
        <div class="comments__in inner " data-anim="stagger-element">
            <h3 class="title-h2 comments__title" data-anim="stagger-items"> <?= Yii::t('about', 'Отзывы от наших клиентов-учителей из Китая') ?> </h3>
            <div class="slider-bg"></div>
            <div class="slider-outer">
                <div class="comments__slider slider_default slider_fixed slider js-slider" data-url-sprite="<?= Url::to('/img/sprite.svg#icon-arrow') ?>">
                    <?php foreach ($reviews as $review): ?>
                    <div class="slider__slide">
                        <div class="slider__left">
                            <div class="slider__img">
                                <img src="<?= Review::getImageUrl($review['image'], 420, 420) ?>" alt="image">
                            </div>
                            <div class="slider__author" data-anim="stagger-element"> <?= $review['author'] ?></div>
                        </div>
                        <div class="slider__right">
                            <div class="slider__container">
                                <div class="slider__info" data-anim="stagger-items"> <?= $review['title'] ?></div>
                                <p data-anim="stagger-items"> <?= $review['text'] ?> </p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="comments__all">
                <a href="<?= Url::to('reviews') ?>" class="link" data-anim="stagger-element"><span> <?= Yii::t('about', 'все отзывы') ?> </span>
                    <svg class="icon icon-arrow">
                        <use xlink:href="<?= Url::to('/img/sprite.svg#icon-arrow') ?>"></use>
                    </svg>
                </a>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="questions" data-section="" data-anim="group">
        <div class="buble-img buble-img_left" data-anim="stagger-element"><img src="<?= Url::to('/static/img/about-bubles/8.png') ?>" alt=""></div>
        <div class="buble-img buble-img_right "><img src="<?= Url::to('/static/img/about-bubles/9.png') ?>" alt=""></div>
        <div class="questions__in inner inner_mob">
            <div class="pull-left"><h2 class="title-h2 questions__title" data-anim="stagger-items"> <?= Yii::t('about', 'Есть вопросы о переезде, работе или жизни в Китае?') ?> </h2>
                <a class="btn questions__btn" href="<?= Url::to(['/faq']) ?>" data-anim="stagger-element"><?= Yii::t('about', 'Задать вопрос') ?></a>
            </div>
        </div>
    </div>
</div>
<?= ClientRequestPopup::widget() ?>
