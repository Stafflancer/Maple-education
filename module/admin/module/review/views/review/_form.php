<?php
/**
 * Create/update form view.
 */

use app\components\ImageBehavior;
use app\module\admin\models\Banner;
use app\module\admin\models\Language;
use app\module\admin\module\review\models\Review;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $review app\module\admin\module\review\models\Review */
/* @var $descriptions array */
/* @var $languages array */
/* @var $form yii\widgets\ActiveForm */

$placeholder = ImageBehavior::placeholder(100, 100);
?>

<div class="review-form box box-primary">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="box-body table-responsive">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#main" aria-controls="home" role="tab" data-toggle="tab">Основное</a></li>
            <li role="presentation"><a href="#data" aria-controls="profile" role="tab" data-toggle="tab">Данные</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="main">
                <div class="box-body">
                    <div class="form-group">

                        <?= Html::label($review->getAttributeLabel('image'), 'input-file-image', ['class' => 'control-label', 'style' => 'display: block;']) ?>

                        <a href="" id="thumb-image" data-toggle="review-image" class="img-thumbnail">
                            <img src="<?= $review->resizeImage($review->image, 100, 100) ?>" alt="" title="" class="image-thumbnail" data-placeholder="<?= $placeholder ?>" />
                        </a>
                        <input type="hidden" name="Review[image]" value="<?= $review->image ?>" id="input-image" />

                        <input type="file" accept="image/*" id="input-file-image" class="input-file-image" name="Review[imageFile]" value="" onchange="onImageChange(this)" style="display: none" />
                    </div>

                    <?php if (!empty($languages)): ?>
                    <ul class="nav nav-tabs" id="language">
                        <?php foreach ($languages as $language): ?>
                            <li role="presentation"><a href="#language<?= $language['language_id'] ?>" data-toggle="tab"><img src="<?= Language::getImageUrl($language['image'], 16, 16) ?>" title="<?= $language['name'] ?>" /> <?= $language['name'] ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="tab-content">
                        <?php foreach ($descriptions as $key => $description): ?>
                        <div role="tabpanel" class="tab-pane active" id="language<?= $key ?>">
                            <div class="box-body">
                                <?= $form->field($description, 'author')->textInput([
                                    'id' => 'review-description-author-' . $key,
                                    'name' => 'ReviewDescription[' . $key . '][author]',
                                ]) ?>

                                <?= $form->field($description, 'title')->textInput([
                                    'id' => 'review-description-title-' . $key,
                                    'name' => 'ReviewDescription[' . $key . '][title]',
                                ]) ?>

                                <?= $form->field($description, 'text')->textarea([
                                    'id' => 'review-description-text-' . $key,
                                    'name' => 'ReviewDescription[' . $key . '][text]',
                                    'maxlength' => true
                                ]) ?>
                            </div>
                        </div>
                        <?php endforeach ?>
                    </div>
                    <?php else: ?>
                        <p><?= Html::a('Активируйте', ['language/index']) ?> или добавьте, пожалуйста, один или более языков!</p>
                    <?php endif; ?>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="data">
                <div class="box-body">
                    <?= $form->field($review, 'banner_id')->dropDownList(Banner::getList()) ?>

                    <?= $form->field($review, 'status')->dropDownList(Review::getStatusesList()) ?>

                    <?= $form->field($review, 'sort_order')->textInput() ?>
                </div>
            </div>
        </div>

    </div>
    <div class="box-footer">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<style>
    .img-thumbnail {
        width: 110px;
        height: 110px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .img-thumbnail img {
        max-width: 100%;
        max-height: 100%;
    }
</style>
<?php
$this->registerJs(
    "
    $('#language a:first').tab('show');
    ",
    View::POS_READY,
    'script'
);
?>
<?php
$this->registerJs(
    "
    function onImageChange(item) {
        if (!item.value) {
            return;
        }

        var src = window.URL.createObjectURL(item.files[0]);
        
        $(item).closest('div').find('.image-thumbnail').attr('src', src);
    }
    ",
    View::POS_END,
    'script2'
);
?>
