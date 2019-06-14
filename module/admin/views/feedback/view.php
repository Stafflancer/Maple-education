<?php
/**
 * Feedback view.
 */

use app\module\admin\models\Feedback;

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\Feedback */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Обратная связь', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-view box box-primary">
    <div class="box-header">
        <?= Html::a('<i class="fa fa-reply"></i>', Yii::$app->request->referrer, [
            'class' => 'btn btn-default btn-flat',
        ]) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->feedback_id], [
            'class' => 'btn btn-danger btn-flat',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
    </div>
    <div class="box-body table-responsive">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'name',
                'email:email',
                'message:ntext',
                [
                    'attribute' => 'status',
                    'format' => 'raw',
                    'value' => Feedback::getStatusName($model->status),
                ],
                'created_at:datetime',
            ],
        ]) ?>
    </div>
</div>
