<?php

/* @var $this yii\web\View */

use app\module\admin\models\Feedback;
use app\module\admin\module\faq\models\Faq;
use app\module\admin\module\request\models\Request;
use app\module\admin\module\review\models\Review;
use yii\helpers\Url;

$this->title = Yii::$app->name;
?>
<div class="site-index">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?= Review::getAllCount() ?></h3>

                    <p>Отзывы</p>
                </div>
                <div class="icon">
                    <i class="fa fa-thumbs-up"></i>
                </div>
                <a href="<?= Url::to(['/admin/review/review']) ?>" class="small-box-footer">
                    Подробнее... <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?= Request::getAllCount() ?></h3>

                    <p>Заявки</p>
                </div>
                <div class="icon">
                    <i class="fa fa-phone-square"></i>
                </div>
                <a href="<?= Url::to(['/admin/request/request']) ?>" class="small-box-footer">
                    Подробнее... <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?= Faq::getAllCount() ?></h3>

                    <p>FAQ</p>
                </div>
                <div class="icon">
                    <i class="fa fa-question-circle-o"></i>
                </div>
                <a href="<?= Url::to(['/admin/faq/faq']) ?>" class="small-box-footer">
                    Подробнее... <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3><?= Feedback::getAllCount() ?></h3>

                    <p>Обратная связь</p>
                </div>
                <div class="icon">
                    <i class="fa fa-comments-o"></i>
                </div>
                <a href="<?= Url::to(['/admin/feedback']) ?>" class="small-box-footer">
                    Подробнее... <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>
