<?php
/**
 * Create/update form view.
 */

use app\module\admin\models\Language;
use app\module\admin\module\faq\models\Faq;
use app\module\admin\module\faq\models\FaqCategory;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $faq app\module\admin\module\faq\models\Faq */
/* @var $descriptions array */
/* @var $languages array */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="faq-form box box-primary">

    <?php $form = ActiveForm::begin(); ?>

    <div class="box-body table-responsive">
        <?= $form->field($faq, 'faq_category_id')->dropDownList(FaqCategory::getList()) ?>

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
                            <?= $form->field($description, 'question')->textInput([
                                'id' => 'faq-description-question-' . $key,
                                'name' => 'FaqDescription[' . $key . '][question]',
                            ]) ?>

                            <?= $form->field($description, 'answer')->widget(CKEditor::className(), [
                                'options' => [
                                    'id' => 'faq-description-answer-' . $key,
                                    'name' => 'FaqDescription[' . $key . '][answer]',
                                    'rows' => 6,
                                ],
                                'clientOptions' => [
                                    'allowedContent' => true,
                                    'fillEmptyBlocks' => false,
                                    'autoParagraph' => false
                                ],
                                'preset' => 'custom',
                            ]) ?>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        <?php else: ?>
            <p><?= Html::a('Активируйте', ['language/index']) ?> или добавьте, пожалуйста, один или более языков!</p>
        <?php endif; ?>

        <?= $form->field($faq, 'status')->dropDownList(Faq::getStatusesList()) ?>

        <?= $form->field($faq, 'sort_order')->textInput() ?>
    </div>

    <div class="box-footer">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success btn-flat']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
<?php
$this->registerJs(
    "
    $('#language a:first').tab('show');
    ",
    View::POS_READY,
    'script'
);
?>
