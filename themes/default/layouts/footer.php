<?php
/**
 * Footer part of main layout.
 */

use app\module\admin\models\Language;
use yii\helpers\Url;

$languageId = Language::getLanguageIdByCode(Yii::$app->language);
$defaultLanguageId = Language::getLanguageIdByCode(Yii::$app->urlManager->getDefaultLanguage());

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
?>
<div class="footer" data-anim="group">
    <div class="footer__inner inner" data-anim="stagger-element" data-anim-element-delay="0.2" itemscope itemtype="http://schema.org/Organization">
        <div class="footer__wrap">
            <div class="footer__col">
                <a href="<?= Url::to(['/']) ?>" class="f-mob footer__logo logo js-logo new-logo new-logo--footer">
                    <img src="<?= Url::to('/img/logo.png') ?>" alt="Logo" class="new-logo__img">
</div>

        <div class="footer__wrap">
            <div class="footer__col">
<a href="https://www.work.ua/" target="_blank"><img src="https://st.work.ua/i/press_kit/88x31.gif" width="88" height="31" alt="Work.ua � ???? ?????? ?????? ?1 ? ???????" border="0"></a> 
            </div>
            <?= $this->render('_footer_menu') ?>
            <div class="footer__col order-2"><h5 class="footer__title sub-title-small"> <?= Yii::t('footer', 'Телефон') ?> </h5>
                <div class="footer__row"><p> <?= Yii::t('footer', 'Киев') ?>: </p>
                    <?php if (!empty($phones[0])): ?>
                    <p>
                        <a href="tel:<?= preg_replace('/\D+/', '', $phones[0]); ?>">
                            <span itemprop="telephone"><?= $phones[0] ?></span>
                        </a>
                    </p>
                    <?php endif; ?>
                    <?php if (!empty($phones[1])): ?>
                    <p>
                        <a href="tel:<?= preg_replace('/\D+/', '', $phones[1]); ?>">
                            <span itemprop="telephone"><?= $phones[1] ?></span>
                        </a>
                    </p>
                    <?php endif; ?>
                </div>
                <div class="footer__row">
                    <p> <?= Yii::t('footer', 'Пекин') ?>: </p>
                    <?php if (!empty($phones2[0])): ?>
                    <p>
                        <a href="tel:<?= preg_replace('/\D+/', '', $phones2[0]); ?>"><span itemprop="telephone"><?= $phones2[0] ?></span></a>
                    </p>
                    <?php endif; ?>
                    <?php if (!empty($phones2[1])): ?>
                    <p>
                        <a href="tel:<?= preg_replace('/\D+/', '', $phones2[1]); ?>"><span itemprop="telephone"><?= $phones2[1] ?></span></a>
                    </p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="footer__col order-1">
                <?php if (!empty($whatsapp)): ?>
                <div class="footer__elem">
                    <h5 class="footer__title sub-title-small"> <?= Yii::t('footer', 'WhatsApp') ?>: </h5>
                    <a href="whatsapp://send?phone=<?= preg_replace('/\D+/', '', $whatsapp); ?>"><?= $whatsapp ?></a>
                </div>
                <?php endif; ?>
                <?php if (!empty($email)): ?>
                <div class="footer__elem">
                    <h5 class="footer__title sub-title-small"> <?= Yii::t('footer', 'Почта') ?> </h5>
                    <a href="mailto:taisiia@maple-education.com">
                        <span itemprop="email"><?= $email ?></span>
                    </a>
                </div>
                <?php endif; ?>
                <div class="footer__abs">
                    <h5 class="footer__title sub-title-small"> <?= Yii::t('footer', 'Принимаем платежи') ?> </h5>
                    <ul class="payments">
                        <?php if (!empty($liqpay)): ?>
                        <li class="payments__item">
                            <a class="payments__link" href="<?= $liqpay ?>" rel="nofollow" target="_blank">
                                <svg class="icon icon-master_card">
                                    <use xlink:href="<?= Url::to('/img/sprite.svg#icon-inst') ?>"></use>
                                </svg>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if (!empty($visa)): ?>
                        <li class="payments__item">
                            <a class="payments__link" href="<?= $visa ?>" rel="nofollow" target="_blank">
                                <svg class="icon icon-visa">
                                    <use xlink:href="<?= Url::to('/img/sprite.svg#icon-fb') ?>"></use>
                                </svg>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class="footer__col order-3"><h5 class="footer__title sub-title-small"> <?= Yii::t('footer', 'Офис') ?> </h5>
                <?php if (!empty($address)): ?>
                <div class="footer__row"><p> <?= Yii::t('footer', 'Киев') ?>: <?= $address ?> </p></div>
                <?php endif; ?>
                <?php if (!empty($address2)): ?>
                <div class="footer__row"><p> <?= Yii::t('footer', 'Пекин') ?>: <?= $address2 ?> </p></div>
                <?php endif; ?>
            </div>
        </div>
        <div class="footer__wrap">
            <div class="footer__copy copy"> © 2013 - <?= date('Y', time()) ?> <?= $siteName ?></div>
        </div>
    </div>
</div>