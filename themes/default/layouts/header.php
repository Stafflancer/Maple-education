<?php
/**
 * Header part of main layout.
 */

/* @var $this \yii\web\View */

use app\module\admin\models\DesignForm;
use app\module\admin\models\Language;
use app\widgets\LanguagePicker;
use yii\helpers\Url;

$languageId = Language::getLanguageIdByCode(Yii::$app->language);
$defaultLanguageId = Language::getLanguageIdByCode(Yii::$app->urlManager->getDefaultLanguage());

$slogan = !empty(Yii::$app->params['slogan'][$languageId]) ? Yii::$app->params['slogan'][$languageId]
    : (!empty(Yii::$app->params['slogan'][$defaultLanguageId]) ? Yii::$app->params['slogan'][$defaultLanguageId] : '');
$logo = !empty(Yii::$app->params['logo'][$languageId]) ? Yii::$app->params['logo'][$languageId]
    : (!empty(Yii::$app->params['logo'][$defaultLanguageId]) ? Yii::$app->params['logo'][$defaultLanguageId] : '');
$logoUrl = DesignForm::getImageUrl($logo, 384, 84);

$phones = isset(Yii::$app->params['phones']) ? explode(PHP_EOL, Yii::$app->params['phones']) : null;

?>
<header class="header js-header">

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-83422883-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-83422883-1');
  gtag('config', 'UA-116466423-1');
</script>


    <div class="header__in" itemscope itemtype="http://schema.org/Organization">
        <a href="<?= Url::to(['/']) ?>" class="logo js-logo new-logo">
            <img src="<?= Url::to('/img/logo.png') ?>" alt="Logo" class="new-logo__img">
        </a>
        <button class="btn-menu js-btn-menu">
            <span class="btn-menu__text btn-menu__text_left">
                <span class="btn-menu__text-in js-btn-menu-text"> <?= Yii::t('header', 'ме') ?> </span>
            </span>
            <span class="btn-menu__lines js-btn-menu-lines">
                <span class="btn-menu__line btn-menu__line_top"></span>
                <span class="btn-menu__line btn-menu__line_middle"></span>
                <span class="btn-menu__text-hover"><?= Yii::t('header', 'назад') ?></span>
                <span class="btn-menu__line btn-menu__line_bottom"></span>
            </span>
            <span class="btn-menu__text btn-menu__text_right">
                <span class="btn-menu__text-in js-btn-menu-text"> <?= Yii::t('header', 'ню') ?> </span>
            </span>
        </button>
        <?= LanguagePicker::widget() ?>
        <button class="btn btn_popup js-show-popup" data-mob="<?= Yii::t('header', 'заявка') ?>" data-desktop="<?= Yii::t('header', 'оставить заявку') ?>" data-hover="<?= Yii::t('header', 'оставить заявку') ?>"></button>
    </div>
    <div class="header__drop js-header-drop">
        <div class="header__wpap">
            <div class="header__in">
                <div class="header__top">
                    <a href="<?= Url::to(['/']) ?>" class="logo logo_white js-logo-grop new-logo new-logo--menu">
                        <img src="<?= Url::to('/img/logo.png') ?>" alt="Logo" class="new-logo__img">
                    </a>
                    <div class="phones">
                        <?php if (!empty($phones[0])): ?>
                        <a class="phones__number js-phones-number" href="tel:<?= preg_replace('/\D+/', '', $phones[0]); ?>">
                            <span itemprop="telephone"><?= $phones[0] ?></span>
                        </a>
                        <?php endif; ?>
                        <?php if (!empty($phones[1])): ?>
                        <a class="phones__number js-phones-number" href="tel:<?= preg_replace('/\D+/', '', $phones[1]); ?>">
                            <span itemprop="telephone"><?= $phones[1] ?></span>
                        </a>
                        <?php endif; ?>
                    </div>
                    <?= LanguagePicker::widget(['ulCssClass' => 'lang js-lang-drop', 'liCssClass' => 'lang__item js-lang-drop-item', 'textCssClass' => 'lang__text js-lang-drop-text']) ?>
                </div>
                <?= $this->render('menu') ?>
                <div class="phones phones_mob">
                    <?php if (!empty($phones[0])): ?>
                    <a class="phones__number js-menu-text" href="tel:<?= preg_replace('/\D+/', '', $phones[0]); ?>">
                        <span itemprop="telephone"><?= $phones[0] ?></span>
                    </a>
                    <span class="phones__line js-menu-line"></span>
                    <?php endif; ?>
                    <?php if (!empty($phones[1])): ?>
                    <a class="phones__number js-menu-text" href="tel:<?= preg_replace('/\D+/', '', $phones[1]); ?>">
                        <span itemprop="telephone"><?= $phones[1] ?></span>
                    </a>
                    <span class="phones__line js-menu-line"></span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</header>
