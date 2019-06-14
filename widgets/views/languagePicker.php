<?php
/**
 * LanguagePicker widget view.
 */

use yii\helpers\Url;

/* @var $currentLanguage array */
/* @var $languages array */
/* @var $ulCssClass string */
/* @var $liCssClass string */
/* @var $textCssClass string */

?>
<?php if (!empty($languages)): ?>
<ul class="<?= $ulCssClass ?>">
    <?php foreach ($languages as $language): ?>
    <?php $isActive = (Yii::$app->language == $language['code']) ? ' is-active' : '' ?>
    <li class="<?= $liCssClass ?><?= $isActive ?>">
        <a class="lang__link" href="<?= Url::to($language['url']) ?>">
            <span class="lang__circle js-lang-circle"></span>
            <span class="lang__line">
                <span class="lang__line-inner"></span>
            </span>
            <span class="<?= $textCssClass ?>"> <?= $language['label'] ?> </span>
        </a>
    </li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>