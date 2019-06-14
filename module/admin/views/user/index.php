<?php
/**
 * User index view.
 */

use app\module\admin\models\User;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\module\admin\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index box box-primary">
    <div class="box-header with-border">
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'username',
                'email:email',
                'phone',
                [
                    'attribute' => 'role',
                    'filter' => User::getRolesList(),
                    'value' => function ($model) {
                        return  User::getRoleName($model->role);
                    }
                ], [
                    'attribute' => 'status',
                    'filter' => User::getStatusesList(),
                    'value' => function ($model) {
                        return  User::getStatusName($model->status);
                    }
                ], [
                    'attribute' => 'created_at',
                    'format' => ['datetime', 'php:d.m.Y H:i'],
                    'filter' => false,
                ], [
                    'attribute' => 'updated_at',
                    'format' => ['datetime', 'php:d.m.Y H:i'],
                    'filter' => false,
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete}',
                    'visibleButtons' => [
                        'delete' => function ($model, $key, $index) {
                            return (User::getAllCount() > 1) ? true : false;
                        }
                    ]
                ],
            ],
        ]); ?>
    </div>
</div>
