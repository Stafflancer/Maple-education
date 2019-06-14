<?php
/**
 * Footer menu part of main layout.
 */

/* @var $this \yii\web\View */

use app\module\admin\models\Language;
use app\module\admin\models\Page;

$languageId = Language::getLanguageIdByCode(Yii::$app->language);
$defaultLanguageId = Language::getLanguageIdByCode(Yii::$app->urlManager->getDefaultLanguage());

$menuItems = Page::getMenuItems($languageId, true);

if (empty($menuItems)) {
    $menuItems = Page::getMenuItems($defaultLanguageId, true);
}

?>
<div class="footer__col f-mob">
    <h5 class="footer__title sub-title-small"> <?= Yii::t('footer', 'Меню') ?> </h5>
    <div class="footer__menu">
        <?php foreach ($menuItems as $menuItem): ?>
        <li><a href="<?= $menuItem['href'] ?>"><?= $menuItem['title'] ?></a></li>
        <?php endforeach; ?>
    </div>
</div>
