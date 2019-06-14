<?php
/**
 * Page update view.
 */

/* @var $this yii\web\View */
/* @var $page app\module\admin\models\Page */
/* @var $descriptions array */
/* @var $seoUrls array */
/* @var $languages array */

$this->title = 'Изменить страницу';
$this->params['breadcrumbs'][] = ['label' => 'Страницы', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Изменить страницу';
?>
<div class="page-update">
    <?= $this->render('_form', [
        'page' => $page,
        'descriptions' => $descriptions,
        'seoUrls' => $seoUrls,
        'languages' => $languages,
    ]) ?>
</div>
