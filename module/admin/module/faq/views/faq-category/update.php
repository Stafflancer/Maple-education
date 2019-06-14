<?php
/**
 * Faq category update view.
 */

/* @var $this yii\web\View */
/* @var $category app\module\admin\module\faq\models\FaqCategory */
/* @var $descriptions array */
/* @var $languages array */

$this->title = 'Изменить категорию';
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Изменить категорию';
?>
<div class="faq-category-update">
    <?= $this->render('_form', [
        'category' => $category,
        'descriptions' => $descriptions,
        'languages' => $languages,
    ]) ?>
</div>
