<?php
/**
 * Design index view.
 */

use app\module\admin\models\Language;

use kartik\color\ColorInput;
use kartik\file\FileInput;

use yii\web\View;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\DesignForm | \app\components\ImageBehavior */
/* @var $form yii\widgets\ActiveForm */
/* @var $languages array */
/* @var $placeholder string */

$this->title = 'Дизайн';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="design-form box box-primary">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="box-body table-responsive">
        <div class="form-group">

            <?= Html::label($model->getAttributeLabel('favicon'), 'input-file-image', ['class' => 'control-label', 'style' => 'display: block;']) ?>

            <a href="" id="thumb-image" data-toggle="design-favicon-image" class="img-thumbnail">
                <img src="<?= $model->resizeImage($model->favicon, 100, 100) ?>" alt="" title="" class="image-thumbnail" data-placeholder="<?= $placeholder ?>" />
            </a>
            <input type="hidden" name="DesignForm[favicon]" value="<?= $model->favicon ?>" id="input-image" />

            <input type="file" accept="image/*" id="input-file-image" class="input-file-image" name="DesignForm[faviconFile]" value="" onchange="onImageChange(this)" style="display: none" />
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
    $('#design-logo a:first').tab('show');

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
    'script'
);
?>
