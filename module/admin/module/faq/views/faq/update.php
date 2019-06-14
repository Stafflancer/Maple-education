<?php
/**
 * Faq update view.
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $faq app\module\admin\module\faq\models\Faq */
/* @var $descriptions array */
/* @var $languages array */

$this->title = 'Изменить вопрос';
$this->params['breadcrumbs'][] = ['label' => 'Вопросы', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Изменить вопрос';
?>
<div class="faq-update">
    <?= $this->render('_form', [
        'faq' => $faq,
        'descriptions' => $descriptions,
        'languages' => $languages,
    ]) ?>
</div>
