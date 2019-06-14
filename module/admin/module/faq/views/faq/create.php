<?php
/**
 * Faq create view.
 */

/* @var $this yii\web\View */
/* @var $faq app\module\admin\module\faq\models\Faq */
/* @var $descriptions array */
/* @var $languages array */

$this->title = 'Добавить вопрос';
$this->params['breadcrumbs'][] = ['label' => 'Вопросы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-create">
    <?= $this->render('_form', [
        'faq' => $faq,
        'descriptions' => $descriptions,
        'languages' => $languages,
    ]) ?>
</div>
