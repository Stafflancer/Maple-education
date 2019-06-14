<?php
/**
 * Review update view.
 */

/* @var $this yii\web\View */
/* @var $review app\module\admin\module\review\models\Review */
/* @var $descriptions array */
/* @var $languages array */

$this->title = 'Изменить отзыв';
$this->params['breadcrumbs'][] = ['label' => 'Отзывы', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Изменить отзыв';
?>
<div class="review-update">
    <?= $this->render('_form', [
        'review' => $review,
        'descriptions' => $descriptions,
        'languages' => $languages,
    ]) ?>
</div>
