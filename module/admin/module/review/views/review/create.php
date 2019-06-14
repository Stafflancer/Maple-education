<?php
/**
 * Review create view.
 */

/* @var $this yii\web\View */
/* @var $review app\module\admin\module\review\models\Review */
/* @var $descriptions array */
/* @var $languages array */

$this->title = 'Добавить отзыв';
$this->params['breadcrumbs'][] = ['label' => 'Отзывы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="review-create">
    <?= $this->render('_form', [
        'review' => $review,
        'descriptions' => $descriptions,
        'languages' => $languages,
    ]) ?>
</div>
