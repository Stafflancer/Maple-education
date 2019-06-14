<?php
/**
 * Static page view.
 */

/* @var $this yii\web\View */
/* @var $page array */
/* @var $defaultPage array */

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

if (!empty($page['content'])) {
    echo $page['content'];
} else {
    $defaultPage['content'];
}
