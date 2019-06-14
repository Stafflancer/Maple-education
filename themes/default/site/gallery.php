<?php
/**
 * Gallery page view.
 */

/* @var $this yii\web\View */
/* @var $page array */
/* @var $defaultPage array */
/* @var $bannerImages array */

use app\module\admin\models\BannerImage;
use Imagine\Image\ManipulatorInterface;
use yii\widgets\Breadcrumbs;

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

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-content__content-wrap  gallery-page  g-page-wraper">
    <div class="page-content__content  gallery-page__content  g-content-wraper">
        <?php try {
            echo Breadcrumbs::widget([
                'itemTemplate' => '<li class="bread-crumbs__item">{link}</li>' . PHP_EOL,
                'activeItemTemplate' => '<li class="bread-crumbs__item">{link}</li>' . PHP_EOL,
                'homeLink' => [
                    'label' => '<svg class="bread-crumbs__link--ico"><use xlink:href="#ico-home"/></svg>' . PHP_EOL,
                    'url' => Yii::$app->homeUrl,
                    'template' => '<li class="bread-crumbs__item">{link}</li>' . PHP_EOL,
                    'class' => 'bread-crumbs__link  bread-crumbs__link--home',
                    'encode' => false,
                ],
                'links' => [$this->title],
                'options' => [
                    'class' => 'page-content__bread-crumbs  bread-crumbs'
                ]
            ]);
        } catch (Exception $e) {
            echo $e->getMessage();
        } ?>
        <h1 class="page-content__title"><?= $this->title ?></h1>
        <?= !empty($page['content']) ? $page['content'] : $defaultPage['content']  ?>
        <?php if (!empty($bannerImages)): ?>
        <div class="gallery-page__imgs-list">
            <?php foreach ($bannerImages as $bannerImage): ?>
            <div class="gallery-page__img-wrap">
                <img src="<?= BannerImage::getImageUrl($bannerImage['image'], 740, 440, ManipulatorInterface::THUMBNAIL_OUTBOUND) ?>"
                     alt="<?= $bannerImage['title'] ?>" class="gallery-page__img"
                     data-large-img="<?= BannerImage::getImageUrl($bannerImage['image'], $bannerImage['image_width'], $bannerImage['image_height']) ?>"
                     data-large-size="<?= $bannerImage['image_width'] ?>x<?= $bannerImage['image_height'] ?>">
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</div>
