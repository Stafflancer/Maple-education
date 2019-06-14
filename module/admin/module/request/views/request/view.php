<?php
/**
 * Request view.
 */

use app\module\admin\module\request\models\Request;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\module\admin\module\request\models\Request */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Заявки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-view box box-primary">
    <div class="box-header">
        <?= Html::a('<i class="fa fa-reply"></i>', Yii::$app->request->referrer, [
            'class' => 'btn btn-default btn-flat',
        ]) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->request_id], [
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
                'phone',
                'email:email',
                'education',
                'english_level',
                'birthday_date',
                [
                    'attribute' => 'status',
                    'format' => 'raw',
                    'value' => Request::getStatusName($model->status),
                ],
                'created_at:datetime',
            ],
        ]) ?>
    </div>
</div>
