<?php
/**
 * Phones widget view.
 */

/* @var $phones array */

?>
<?php if (!empty($phones)): ?>
<div class="page-header__phones  phones">
    <a class="phones__main-link" href="tel:<?= preg_replace('/\D+/', '', $phones[0]); ?>" data-submenu-link>
        <svg class="phones__ico">
            <use xlink:href="#ico-phone"/>
        </svg>
        <?= $phones[0] ?>
        <svg class="phones__arrow">
            <use xlink:href="#ico-arrow"/>
        </svg>
    </a>
    <ul class="phones__submenu  submenu">
        <?php foreach ($phones as $phone): ?>
        <li class="submenu__item">
            <a href="tel:<?= preg_replace('/\D+/', '', $phone); ?>" class="submenu__link">
                <svg class="phones__ico">
                    <use xlink:href="#ico-phone"/>
                </svg>
                <?= $phone ?>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>
