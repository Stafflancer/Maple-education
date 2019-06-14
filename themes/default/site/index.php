<?php
/**
 * Index page view.
 */

use app\module\admin\models\Language;
use app\module\admin\module\review\models\Review;
use app\widgets\ClientRequestPopup;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $page array */
/* @var $defaultPage array */
/* @var $defaultPage array */
/* @var $this yii\web\View */
/* @var $reviews array */
/* @var $clientRequestForm app\models\ClientRequestForm */

$this->params['bodyClass'] = 'has-canvas is-main';

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

$mainPageTopic = !empty(Yii::$app->params['mainPageTopic'][$languageId]) ? Yii::$app->params['mainPageTopic'][$languageId]
    : (!empty(Yii::$app->params['mainPageTopic'][$defaultLanguageId]) ? Yii::$app->params['mainPageTopic'][$defaultLanguageId] : '');
$mainPageOrientation = !empty(Yii::$app->params['mainPageOrientation'][$languageId]) ? Yii::$app->params['mainPageOrientation'][$languageId]
    : (!empty(Yii::$app->params['mainPageOrientation'][$defaultLanguageId]) ? Yii::$app->params['mainPageOrientation'][$defaultLanguageId] : '');
$mainPagePlace = !empty(Yii::$app->params['mainPagePlace'][$languageId]) ? Yii::$app->params['mainPagePlace'][$languageId]
    : (!empty(Yii::$app->params['mainPagePlace'][$defaultLanguageId]) ? Yii::$app->params['mainPagePlace'][$defaultLanguageId] : '');
$mainPageProgram = !empty(Yii::$app->params['mainPageProgram'][$languageId]) ? Yii::$app->params['mainPageProgram'][$languageId]
    : (!empty(Yii::$app->params['mainPageProgram'][$defaultLanguageId]) ? Yii::$app->params['mainPageProgram'][$defaultLanguageId] : '');
$mainPagePayment = !empty(Yii::$app->params['mainPagePayment'][$languageId]) ? Yii::$app->params['mainPagePayment'][$languageId]
    : (!empty(Yii::$app->params['mainPagePayment'][$defaultLanguageId]) ? Yii::$app->params['mainPagePayment'][$defaultLanguageId] : '');
$mainPageAppartement = !empty(Yii::$app->params['mainPageAppartement'][$languageId]) ? Yii::$app->params['mainPageAppartement'][$languageId]
    : (!empty(Yii::$app->params['mainPageAppartement'][$defaultLanguageId]) ? Yii::$app->params['mainPageAppartement'][$defaultLanguageId] : '');
$mainPageConfidence = !empty(Yii::$app->params['mainPageConfidence'][$languageId]) ? Yii::$app->params['mainPageConfidence'][$languageId]
    : (!empty(Yii::$app->params['mainPageConfidence'][$defaultLanguageId]) ? Yii::$app->params['mainPageConfidence'][$defaultLanguageId] : '');
$mainPageApplication = !empty(Yii::$app->params['mainPageApplication'][$languageId]) ? Yii::$app->params['mainPageApplication'][$languageId]
    : (!empty(Yii::$app->params['mainPageApplication'][$defaultLanguageId]) ? Yii::$app->params['mainPageApplication'][$defaultLanguageId] : '');
$mainPageOperations = !empty(Yii::$app->params['mainPageOperations'][$languageId]) ? Yii::$app->params['mainPageOperations'][$languageId]
    : (!empty(Yii::$app->params['mainPageOperations'][$defaultLanguageId]) ? Yii::$app->params['mainPageOperations'][$defaultLanguageId] : '');

?>
<div class="sections">
    <?php if (!empty($mainPageTopic)): ?>
    <div class="topic" id="topic" data-section="topic" data-anim="group">
        <?= $mainPageTopic ?>
    </div>
    <?php endif; ?>
    <?php if (!empty($mainPageOrientation)): ?>
    <div class="orientation" id="orientation" data-section="orientation">
        <?= $mainPageOrientation ?>
    </div>
    <?php endif; ?>
    <?php if (!empty($mainPagePlace)): ?>
    <div class="place" id="place" data-section="place">
        <?= $mainPagePlace ?>
    </div>
    <?php endif; ?>
    <?php if (!empty($mainPageProgram)): ?>
    <div class="program" id="program" data-section="program">
        <?= $mainPageProgram ?>
    </div>
    <?php endif; ?>
    <?php if (!empty($mainPagePayment)): ?>
    <div class="payment" id="payment" data-section="payment">
        <?= $mainPagePayment ?>
    </div>
    <?php endif; ?>
    <?php if (!empty($mainPageAppartement)): ?>
    <div class="appartement" id="appartement" data-section="appartement">
        <?= $mainPageAppartement ?>
    </div>
    <?php endif; ?>
    <?php if (!empty($mainPageConfidence)): ?>
    <div class="confidence" id="confidence" data-section="confidence">
        <?= $mainPageConfidence ?>
    </div>
    <?php endif; ?>
    <?php if (!empty($mainPageApplication)): ?>
    <div class="application" id="application" data-section="application">
        <?= $mainPageApplication ?>
    </div>
    <?php endif; ?>
    <?php if (!empty($reviews)): ?>
    <div class="reviews" data-anim="group" id="reviews" data-section="reviews">
        <div class="reviews__in inner" data-anim="stagger-element" data-anim-element-delay="0.3">
            <h3 class="reviews__title title-h2" data-anim="stagger-items"> <?= Yii::t('main', 'Что говорят о нас клиенты') ?></h3>
            <div class="reviews__slider slider slider_simple js-slider">
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
            <div class="reviews__all">
                <a href="<?= Url::to('reviews') ?>" class="link" data-anim="stagger-element"><span> <?= Yii::t('about', 'все отзывы') ?> </span>
                    <svg class="icon icon-arrow">
                        <use xlink:href=""<?= Url::to('/img/sprite.svg#icon-arrow') ?>"></use>
                    </svg>
                </a>
            </div>
        </div>
        <svg data-section-svg="i" data-section-svg-fill="#ff4350" width="1316px" height="1095px" viewBox="0 0 1316 1095">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g fill="#ff4350">
                    <g>
                        <path d="M1218.2,228 C1250.8,153.9 1309.6,100.2 1252.4,43 C1195.2,-14.3 1102.4,-14.3 1045.1,43 C987.9,100.3 980,183.8 1037.2,241 C1094.5,298.2 1191.7,288.2 1218.2,228 Z" id="i-circle-top-right"></path>
                        <path d="M1226.2,492 C1177,492 1137.2,531.8 1137.2,581 C1137.2,630.2 1177,670 1226.2,670 C1275.4,670 1315.2,630.2 1315.2,581 C1315.2,531.8 1275.4,492 1226.2,492 Z" id="i-circle-middle-right"></path>
                        <path d="M86,937.9 C59.3,953.3 44.9,964 42.7,1000.9 C41.4,1022.8 38.8,1034.2 48.1,1050.3 C72.8,1093.1 127.6,1107.7 170.4,1083 C213.2,1058.3 227.9,1003.6 203.2,960.9 C178.5,918.1 128.8,913.2 86,937.9 Z" id="i-circle-bottom-left"></path>
                        <g transform="translate(0.000000, 91.000000)">
                            <path d="M30,9.8 L118.5,9.8 C141,9.8 148.5,17.3 148.5,39.8 L148.5,512.3 C148.5,534.8 141,542.3 118.5,542.3 L30,542.3 C7.5,542.3 0,534.8 0,512.3 L0,39.8 C0,17.3 7.5,9.8 30,9.8 Z" id="i-big"></path>
                            <path d="M399.7,56.3 L399.7,64.5 C399.7,106.5 386.2,120 344.2,120 L306.7,120 C263.9,120 250.5,106.5 250.5,64.5 L250.5,56.3 C250.5,14.3 264,0.8 306.7,0.8 L344.2,0.8 C386.2,0.8 399.7,14.3 399.7,56.3 Z" id="i-small-top-point"></path>
                            <path d="M395.2,180.8 L395.2,513.8 C395.2,534.8 387.7,542.3 366,542.3 L284.2,542.3 C262.4,542.3 255,534.8 255,513.8 L255,180.8 C255,159.8 262.5,152.3 284.2,152.3 L366,152.3 C387.7,152.3 395.2,159.8 395.2,180.8 Z" id="i-small"></path>
                        </g>
                    </g>
                </g>
            </g>
        </svg>
        <canvas width="1916px" height="1495px" class="section-screen" id="reviews-screen"></canvas>
    </div>
    <?php endif; ?>
    <?php if (!empty($mainPageOperations)): ?>
    <div class="operations" id="operations" data-section="operations">
        <?= $mainPageOperations ?>
    </div>
    <?php endif; ?>
    <div class="feedback" id="feedback" data-section="feedback">
        <div class="feedback__in inner" data-anim="group">
            <div class="feedback__wrap">
                <h3 class="title-h2" data-anim="stagger-items"> <?= Yii::t('main', 'Оставьте заявку и мы вместе сделаем первый шаг') ?> </h3>
                <div class="feedback__container js-blur-container">
                    <div class="feedback__thanks js-thanks"><h3 class="title-h1"> <?= Yii::t('faq', 'Спасибо!') ?> </h3></div>
                    <div class="feedback__blur js-blur">
                        <div class="feedback__inf" data-anim="stagger-items"> <?= Yii::t('main', 'Вышлем примеры резюме </br>и поможем в его составлении') ?></div>
                        <div class="feedback__form form">
                            <?php $form = ActiveForm::begin([
                                'options' => [
                                    'class' => 'send-request-js',
                                    'method' => 'post',
                                ]
                            ]); ?>
                                <?= $form->field($clientRequestForm, 'name', [
                                    'options' => [
                                        'class' => 'form-group form-group js-form-group',
                                        'data-anim' => 'stagger-element',
                                        'data-anim-element-delay' => '1'
                                    ],
                                    'template' => "{input}\n{label}\n{hint}\n{error}"
                                ])->textInput([
                                    'class' => 'form-control js-input',
                                ]);
                                ?>

                                <?= $form->field($clientRequestForm, 'phone', [
                                    'options' => [
                                        'class' => 'form-group form-group js-form-group',
                                        'data-anim' => 'stagger-element',
                                        'data-anim-element-delay' => '1.2'
                                    ],
                                    'template' => "{input}\n{label}\n{hint}\n{error}"
                                ])->widget(MaskedInput::class, [
                                    'mask' => "+999-99-999-9999",
                                    'options' => [
                                        'class' => 'form-control js-input',
                                    ],
                                    'clientOptions' => [
                                        'showMaskOnHover' => false,
                                    ],
                                ]);
                                ?>

                                <?= Html::submitButton(Yii::t('main', 'Оставить заявку'), [
                                    'class' => 'btn btn_submit',
                                    'data-anim' => 'stagger-element',
                                    'data-anim-element-delay' => '1.4',
                                    'data-success-text' => Yii::t('faq', 'Спасибо!'),
                                    'data-hover' => Yii::t('main', 'Оставить заявку'),
                                ]) ?>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <svg data-section-svg="k" data-section-svg-fill="#00acc1" width="1061px" height="755px" viewBox="0 0 861 555">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g fill="#00acc1">
                    <g>
                        <path d="M426,555 L345,555 C305.2,555 291,549.8 278.2,523.5 L213,389.2 C201,365.2 190.5,351.7 162,351.7 L148.5,351.7 L148.5,523.5 C148.5,546.7 141,555 117,555 L32.2,555 C8.2,555 0,546.8 0,523.5 L0,54 C0,30.8 8.2,22.5 32.2,22.5 L117,22.5 C141,22.5 148.5,30.7 148.5,54 L148.5,220.5 L159,220.5 L165,220.5 L273,50.2 C287.2,27 294,22.4 333,22.4 L419.2,22.4 C441.7,22.4 449.2,35.9 437.2,55.4 L300.8,273 C319.6,286.5 333.8,305.2 346.6,330.8 L445.6,518.3 C456,538.5 450.8,555 426,555 Z" id="k-big"></path>
                        <path d="M830.2,555 L761.2,555 C726.7,555 715.4,550.5 706.4,526.5 L672.6,436.5 C665.8,420.7 655.4,414 638.1,414 L624.6,414 L624.6,525.8 C624.6,547.6 617.1,555 595.4,555 L513.6,555 C491.8,555 485.1,547.5 485.1,525.8 L485.1,29.2 C485.2,7.5 492,0 513.7,0 L595.5,0 C617.3,0 624.7,7.5 624.7,29.2 L624.7,300 L636,300 L640.5,300 L703.5,192 C715.5,169.5 725.3,165 757.5,165 L824.3,165 C854.3,165 861.1,179.2 847.5,201.8 L762.7,347.3 C771.7,354.8 779.9,366.1 787.5,381.1 L853.5,516.9 C867,543 861,555 830.2,555 Z" id="k-small"></path>
                    </g>
                </g>
            </g>
        </svg>
        <canvas width="1461px" height="850px" class="section-screen" id="feedback-screen"></canvas>
    </div>
    <?= ClientRequestPopup::widget() ?>
</div>
<div class="navigation js-navigation">
    <div class="navigation__in js-navigation-in">
        <div class="navigation__list" data-navigation="list">
            <div class="navigation__wrap-links" data-navigation="wrap-links">
                <?php if (!empty($mainPageTopic)): ?>
                <div class="navigation__item js-navigation-item">
                    <div class="navigation__line"></div>
                    <a href="#topic" class="navigation__link js-navigation-link"><span class="navigation__text"> <?= $siteName ?> </span></a>
                </div>
                <?php endif; ?>
                <?php if (!empty($mainPageOrientation)): ?>
                <div class="navigation__item js-navigation-item">
                    <div class="navigation__line"></div>
                    <a href="#" class="navigation__link js-navigation-link"><span class="navigation__text"></span></a>
                </div>
                <?php endif; ?>
                <?php if (!empty($mainPagePlace)): ?>
                <div class="navigation__item js-navigation-item">
                    <div class="navigation__line"></div>
                    <a href="#place" class="navigation__link js-navigation-link"><span class="navigation__text"> <?= Yii::t('main', 'Места работы') ?> </span></a>
                </div>
                <?php endif; ?>
                <?php if (!empty($mainPageProgram)): ?>
                <div class="navigation__item js-navigation-item">
                    <div class="navigation__line"></div>
                    <a href="#program" class="navigation__link js-navigation-link"><span class="navigation__text"> <?= Yii::t('main', 'Стоимость') ?> </span></a>
                </div>
                <?php endif; ?>
                <?php if (!empty($mainPageAppartement)): ?>
                <div class="navigation__item js-navigation-item">
                    <div class="navigation__line"></div>
                    <a href="#appartement" class="navigation__link js-navigation-link"><span class="navigation__text"> <?= Yii::t('main', 'Жилье') ?> </span></a>
                </div>
                <?php endif; ?>
                <?php if (!empty($mainPageConfidence)): ?>
                <div class="navigation__item js-navigation-item">
                    <div class="navigation__line"></div>
                    <a href="#confidence" class="navigation__link js-navigation-link"><span class="navigation__text"> <?= Yii::t('main', 'Нам доверяют') ?> </span></a>
                </div>
                <?php endif; ?>
                <?php if (!empty($mainPageApplication)): ?>
                <div class="navigation__item js-navigation-item">
                    <div class="navigation__line"></div>
                    <a href="#application" class="navigation__link js-navigation-link"><span class="navigation__text"> <?= Yii::t('main', 'Приложение ESL') ?> </span></a>
                </div>
                <?php endif; ?>
                <div class="navigation__item js-navigation-item">
                    <div class="navigation__line"></div>
                    <a href="#reviews" class="navigation__link js-navigation-link"><span class="navigation__text"> <?= Yii::t('main', 'Отзывы') ?> </span></a>
                </div>
                <?php if (!empty($mainPageOperations)): ?>
                <div class="navigation__item js-navigation-item">
                    <div class="navigation__line"></div>
                    <a href="#operations" class="navigation__link js-navigation-link"><span class="navigation__text"> <?= Yii::t('main', 'Как это работает') ?> </span></a>
                </div>
                <?php endif; ?>
                <div class="navigation__item js-navigation-item">
                    <div class="navigation__line"></div>
                    <a href="#feedback" class="navigation__link js-navigation-link"><span class="navigation__text"> <?= Yii::t('main', 'Отправить заявку') ?> </span></a>
                </div>
            </div>
            <a class="btn-down js-btn-down" href="#orientation">
                <span class="btn-down__line js-btn-down-line">
                    <span class="btn-down__line-in"></span>
                </span>
                <span class="btn-down__text js-btn-down-text"> <?= Yii::t('main', 'Вниз') ?> </span>
            </a>
        </div>
    </div>
</div>
