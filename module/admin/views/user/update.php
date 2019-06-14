<?php
/**
 * User update view.
 */

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\User */

$this->title = 'Изменить пользователя';
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Изменить пользователя';
?>
<div class="user-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
