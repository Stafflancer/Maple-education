<?php
/**
 * Menu part of main layout.
 */

/* @var $this \yii\web\View */

use app\module\admin\models\Language;
use app\module\admin\models\Page;

$languageId = Language::getLanguageIdByCode(Yii::$app->language);
$defaultLanguageId = Language::getLanguageIdByCode(Yii::$app->urlManager->getDefaultLanguage());

$menuItems = Page::getMenuItems($languageId);

if (empty($menuItems)) {
    $menuItems = Page::getMenuItems($defaultLanguageId);
}

?>
<nav class="menu header__menu">
    <ul class="menu__list js-menu-list">
        <?php foreach ($menuItems as $menuItem): ?>
        <li class="menu__item js-menu-item">
            <a href="<?= $menuItem['href'] ?>" class="menu__link">
                <span class="menu__line js-menu-line"></span>
                <span class="menu__text js-menu-text"> <?= $menuItem['title'] ?> </span>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
</nav>
