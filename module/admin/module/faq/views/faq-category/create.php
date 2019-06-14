<?php
/**
 * Faq category create view.
 */

/* @var $this yii\web\View */
/* @var $category app\module\admin\module\faq\models\FaqCategory */
/* @var $descriptions array */
/* @var $languages array */

$this->title = 'Добавить категорию';
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-category-create">
    <?= $this->render('_form', [
        'category' => $category,
        'descriptions' => $descriptions,
        'languages' => $languages,
    ]) ?>
</div>
