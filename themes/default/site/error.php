<?php
/**
 * Error view.
 */

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<div class="err-page">
    <div class="inner">
        <div class="err-page__img"><img src="<?= Url::to('/static/img/404/404.svg') ?>" alt=""></div>
        <div class="err-page__content">
            <div class="err-page__left">
                <div class="err-page__info"> <?= Yii::t('error', 'Oops! Запрошенная страница не найдена, перейти') ?>
                    <a href="<?= Url::to(['/']) ?>" class="err-page__link"><span> <?= Yii::t('error', 'на главную') ?> </span></a>
                </div>
            </div>
        </div>
    </div>
</div>
