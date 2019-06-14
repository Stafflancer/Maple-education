<?php
/**
 * Reviews page view.
 */

/* @var $this yii\web\View */
/* @var $page array */
/* @var $defaultPage array */
/* @var $reviewsDataProvider yii\data\ActiveDataProvider */

use app\module\admin\models\BannerImage;
use app\module\admin\models\Language;
use app\module\admin\module\review\models\Review;
use app\widgets\ClientRequestPopup;
use yii\helpers\Url;
use app\components\LinkPager;

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
<div class="promo reviews-promo" data-anim="group">
    <div class="buble-img" data-anim="stagger-element"><img src="<?= Url::to('/static/img/reviews-bubles/1.png') ?>" alt=""></div>
    <div class="promo__in inner inner_mob">
        <div class="promo__left">
            <h1 class="title-h1 reviews-promo__title" data-anim="stagger-items"> <?= Yii::t('reviews', 'Наши клиенты, которые живут и работают учителями в Китае') ?> </h1>
            <div class="promo__info-block info-block info-block_long js-info-block">
                <div class="info-block__line js-info-block-line"></div>
                <div class="info-block__text" data-anim="stagger-items"> <?= Yii::t('reviews', 'По просьбе клиентов, личные контакты скрыты от публичного просмотра') ?> </div>
            </div>
        </div>
    </div>
</div>
<?php if ($reviewsDataProvider->getTotalCount() > 0): ?>
<div id="w0" class="reviews-container">
    <?php $index = 1; ?>
    <?php foreach ($reviewsDataProvider->getModels() as $key => $review): ?>
    <?php $cssClass = ($index == 1) ? 'top' : (($index == 2) ? 'center' : 'bottom') ?>
    <div data-key="<?= $review['review_id'] ?>">
        <div class="reviews-item reviews-item_<?= $cssClass ?>" id="id<?= $key + 1 ?>" data-anim="group">
            <div class="buble-img" data-anim="stagger-element">
                <img src="<?= Url::to('/static/img/reviews-bubles/' . ($index + 1) . '.png') ?>" alt="">
            </div>
            <div class="reviews-item__in inner inner_mob" data-anim="stagger-element">
                <div class="reviews-item__left">
                    <div class="slider-outer">
                        <div class="slider__wrap">
                            <div class="slider__border"></div>
                            <div class="slider__img-small"><img src="<?= Review::getImageUrl($review['image'], 150, 150) ?>" alt="image"></div>
                        </div>
                        <div class="reviews-slider slider_small slider js-slider" data-url-sprite="<?= Url::to('/img/sprite.svg#icon-arrow') ?>">
                            <?php foreach ($review['images'] as $key2 => $image): ?>
                            <div class="slider__slide">
                                <div class="slider__inner">
                                    <div class="slider__img">
                                        <div class="slider__jaw"></div>
                                        <?php if (!empty($image['link'])): ?>
                                        <?php $linkParts = explode('/', $image['link']); ?>
                                        <?php $link = str_replace('?t=', '?start=', end($linkParts)); ?>
                                        <?php $delimiter = strpos($link, '?start=') ? '&' : '?' ?>
                                        <iframe id="iframe_<?= $key2 ?>" class="myVideoClass" style="height:100%; width: 100%" src="https://www.youtube.com/embed/<?= $link ?><?= $delimiter ?>controls=0&iv_load_policy=0&modestbranding=0&showinfo=0&enablejsapi=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                        <?php else: ?>
                                        <img src="<?= BannerImage::getImageUrl($image['image'], 420, 420) ?>" alt="<?= $image['title'] ?>">
                                        <?php endif; ?>
                                    </div>

                                </div>
                            </div>
                            <?php endforeach;  ?>
                        </div>
                        <div class="slider__author" data-anim="stagger-element"> <?= $review['author'] ?></div>
                    </div>
                </div>
                <div class="reviews-item__right">
                    <div class="slider__container">
                        <div class="slider__info" data-anim="stagger-items"> <?= $review['title'] ?> </div>
                        <p data-anim="stagger-items"> <?= $review['text'] ?> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $index++; ?>
    <?php endforeach; ?>
</div>
<?php endif; ?>
<div class="reviews-bottom" data-anim="group">
    <div class="inner">
        <?php
        try {
            echo LinkPager::widget([
                'pagination' => $reviewsDataProvider->pagination,
                'options' => [
                    'class' => 'pagination',
                    'tag' => 'div',
                    'data-anim' => 'stagger-element',
                ],
                'linkOptions' => [
                    'class' => 'pagination__item',
                ],
                'activePageCssClass' => 'is-active',
                'disabledPageCssClass' => 'is-disabled',
                'prevPageCssClass' => 'pagination-btn pagination__prev',
                'nextPageCssClass' => 'pagination-btn pagination__next',
                'prevPageLabel' => '<svg class="icon icon-arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="/img/sprite.svg#icon-arrow"></use></svg><span>' . Yii::t('reviews', 'назад') . '</span>',
                'nextPageLabel' => '<span>' . Yii::t('reviews', 'вперед') . '</span><svg class="icon icon-arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="/img/sprite.svg#icon-arrow"></use></svg>',
            ]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        ?>
    </div>
</div>
<?= ClientRequestPopup::widget() ?>
