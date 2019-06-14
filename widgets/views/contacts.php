<?php
/**
 * Contacts widget view.
 */

/* @var $email string */
/* @var $phones array */

?>
<?php if (!empty($phones[0])): ?>
<div class="short-contacts__item">
    <div class="short-contacts__ico-wrap  g-center">
        <svg class="short-contacts__ico  short-contacts__ico--phone">
            <use xlink:href="#ico-phone"/>
        </svg>
    </div>
    <p class="short-contacts__text-wrap">
        <?php foreach ($phones as $phone): ?>
        <a href="tel:<?= preg_replace('/\D+/', '', $phone); ?>" class="short-contacts__link"><?= $phone ?></a><br>
        <?php endforeach; ?>
    </p>
</div>
<?php endif; ?>
<?php if (!empty($email)): ?>
<div class="short-contacts__item">
    <div class="short-contacts__ico-wrap  g-center">
        <svg class="short-contacts__ico  short-contacts__ico--send">
            <use xlink:href="#ico-send"/>
        </svg>
    </div>
    <p class="short-contacts__text-wrap">
        <a href="mailto:<?= $email ?>" class="short-contacts__link"><?= $email ?></a>
    </p>
</div>
<?php endif; ?>
