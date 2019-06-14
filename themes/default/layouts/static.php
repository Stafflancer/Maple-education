<?php
/**
 * Static page layout.
 */

/* @var $this \yii\web\View */
/* @var $content string */


use app\module\admin\models\DesignForm;
use app\module\admin\models\Language;
use app\assets\AppAsset;
use app\widgets\ClientRequestPopup;
use yii\helpers\Html;

AppAsset::register($this);

$languageId = Language::getLanguageIdByCode(Yii::$app->language);
$defaultLanguageId = Language::getLanguageIdByCode(Yii::$app->urlManager->getDefaultLanguage());

$titlePrefix = !empty(Yii::$app->params['titlePrefix'][$languageId]) ? Yii::$app->params['titlePrefix'][$languageId]
    : (!empty(Yii::$app->params['titlePrefix'][$defaultLanguageId]) ? Yii::$app->params['titlePrefix'][$defaultLanguageId] : '');
$titlePostfix = !empty(Yii::$app->params['titlePostfix'][$languageId]) ? Yii::$app->params['titlePostfix'][$languageId]
    : (!empty(Yii::$app->params['titlePostfix'][$defaultLanguageId]) ? Yii::$app->params['titlePostfix'][$defaultLanguageId] : '');

if (Yii::$app->request->url != '/') {
    $this->title = $titlePrefix . $this->title . $titlePostfix;
}

$favicon = !empty(Yii::$app->params['favicon']) ? DesignForm::getImageUrl(Yii::$app->params['favicon'], 32, 32) : '/favicon.ico';

$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => $favicon]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="out">
    <?= $this->render('header') ?>
    <?= $content ?>
    <?= ClientRequestPopup::widget() ?>
    <?= $this->render('footer') ?>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
