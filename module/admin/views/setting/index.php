<?php
/**
 * Setting index view.
 */

use app\module\admin\models\Banner;
use app\module\admin\models\Language;
use app\module\admin\models\Module;
use app\module\admin\models\Page;
use dosamigos\ckeditor\CKEditor;
use yii\web\View;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\module\admin\models\SettingForm */
/* @var $form yii\widgets\ActiveForm */
/* @var $languages array */

$this->title = 'Общие настройки';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="setting-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#main" aria-controls="main" role="tab" data-toggle="tab">Основное</a></li>
            <li role="presentation"><a href="#main-page" aria-controls="main-page" role="tab" data-toggle="tab">Главная страница</a></li>
            <li role="presentation"><a href="#pages" aria-controls="pages" role="tab" data-toggle="tab">Другие страницы</a></li>
            <li role="presentation"><a href="#mail" aria-controls="mail" role="tab" data-toggle="tab">Почта</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="main">
                <div class="box-body">

                    <?= $form->field($model, 'siteName')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'languageId')->dropDownList(Language::getList()) ?>

                    <?php if (!empty($languages)): ?>
                        <ul class="nav nav-tabs" id="setting-slogan">
                            <?php foreach ($languages as $language): ?>
                                <li role="presentation"><a href="#setting-slogan-<?= $language['language_id'] ?>" data-toggle="tab"><img src="<?= Language::getImageUrl($language['image'], 16, 16) ?>" title="<?= $language['name'] ?>" /> <?= $language['name'] ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="tab-content">
                            <?php foreach ($languages as $language): ?>
                                <div role="tabpanel" class="tab-pane active" id="setting-slogan-<?= $language['language_id'] ?>">
                                    <div class="box-body">
                                        <?= $form->field($model, "titlePrefix" . "[" . $language['language_id'] . "]") ?>

                                        <?= $form->field($model, "titlePostfix" . "[" . $language['language_id'] . "]") ?>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    <?php else: ?>
                        <p><?= Html::a('Активируйте', ['language/index']) ?> или добавьте, пожалуйста, один или более языков!</p>
                    <?php endif; ?>
                    <fieldset>
                        <legend>Контакты</legend>

                        <?php if (!empty($languages)): ?>
                            <ul class="nav nav-tabs" id="setting-address">
                                <?php foreach ($languages as $language): ?>
                                    <li role="presentation"><a href="#setting-address-<?= $language['language_id'] ?>" data-toggle="tab"><img src="<?= Language::getImageUrl($language['image'], 16, 16) ?>" title="<?= $language['name'] ?>" /> <?= $language['name'] ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                            <div class="tab-content">
                                <?php foreach ($languages as $language): ?>
                                    <div role="tabpanel" class="tab-pane active" id="setting-address-<?= $language['language_id'] ?>">
                                        <div class="box-body">
                                            <?= $form->field($model, "workingHours" . "[" . $language['language_id'] . "]")->widget(CKEditor::className(), [
                                                'options' => [
                                                    'rows' => 6,
                                                ],
                                                'clientOptions' => [
                                                    'allowedContent' => true,
                                                    'fillEmptyBlocks' => false,
                                                    'autoParagraph' => false
                                                ],
                                                'preset' => 'custom',
                                            ]) ?>

                                            <?= $form->field($model, "address" . "[" . $language['language_id'] . "]") ?>

                                            <?= $form->field($model, "address2" . "[" . $language['language_id'] . "]") ?>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        <?php else: ?>
                            <p><?= Html::a('Активируйте', ['language/index']) ?> или добавьте, пожалуйста, один или более языков!</p>
                        <?php endif; ?>

                        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'whatsapp')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'phones')->textarea(['maxlength' => true]) ?>

                        <?= $form->field($model, 'phones2')->textarea(['maxlength' => true]) ?>
                    </fieldset>

                    <fieldset>
                        <legend>Google Maps</legend>

                        <?= $form->field($model, 'mapLat')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'mapLng')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'mapZoom')->textInput(['maxlength' => true]) ?>

                    </fieldset>

                    <fieldset>
                        <legend>Системы оплаты</legend>

                        <?= $form->field($model, 'liqpay')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'visa')->textInput(['maxlength' => true]) ?>

                    </fieldset>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="main-page">
                <div class="box-body">
                    <?= $form->field($model, 'mainPageId')->dropDownList(Page::getList()) ?>

                    <fieldset>
                        <legend>Разделы</legend>

                        <?php if (!empty($languages)): ?>
                            <ul class="nav nav-tabs" id="setting-product-page-payment-delivery-descr">
                                <?php foreach ($languages as $language): ?>
                                    <li role="presentation"><a href="#setting-product-page-payment-delivery-descr-<?= $language['language_id'] ?>" data-toggle="tab"><img src="<?= Language::getImageUrl($language['image'], 16, 16) ?>" title="<?= $language['name'] ?>" /> <?= $language['name'] ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                            <div class="tab-content">
                                <?php foreach ($languages as $language): ?>
                                    <div role="tabpanel" class="tab-pane active" id="setting-product-page-payment-delivery-descr-<?= $language['language_id'] ?>">
                                        <div class="box-body">
                                            <?= $form->field($model, "mainPageTopic" . "[" . $language['language_id'] . "]")->widget(CKEditor::className(), [
                                                'options' => [
                                                    'rows' => 6,
                                                ],
                                                'clientOptions' => [
                                                    'allowedContent' => true,
                                                    'fillEmptyBlocks' => false,
                                                    'autoParagraph' => false
                                                ],
                                                'preset' => 'custom',
                                            ]) ?>

                                            <?= $form->field($model, "mainPageOrientation" . "[" . $language['language_id'] . "]")->widget(CKEditor::className(), [
                                                'options' => [
                                                    'rows' => 6,
                                                ],
                                                'clientOptions' => [
                                                    'allowedContent' => true,
                                                    'fillEmptyBlocks' => false,
                                                    'autoParagraph' => false
                                                ],
                                                'preset' => 'custom',
                                            ]) ?>

                                            <?= $form->field($model, "mainPagePlace" . "[" . $language['language_id'] . "]")->widget(CKEditor::className(), [
                                                'options' => [
                                                    'rows' => 6,
                                                ],
                                                'clientOptions' => [
                                                    'allowedContent' => true,
                                                    'fillEmptyBlocks' => false,
                                                    'autoParagraph' => false
                                                ],
                                                'preset' => 'custom',
                                            ]) ?>

                                            <?= $form->field($model, "mainPageProgram" . "[" . $language['language_id'] . "]")->widget(CKEditor::className(), [
                                                'options' => [
                                                    'rows' => 6,
                                                ],
                                                'clientOptions' => [
                                                    'allowedContent' => true,
                                                    'fillEmptyBlocks' => false,
                                                    'autoParagraph' => false
                                                ],
                                                'preset' => 'custom',
                                            ]) ?>

                                            <?= $form->field($model, "mainPagePayment" . "[" . $language['language_id'] . "]")->widget(CKEditor::className(), [
                                                'options' => [
                                                    'rows' => 6,
                                                ],
                                                'clientOptions' => [
                                                    'allowedContent' => true,
                                                    'fillEmptyBlocks' => false,
                                                    'autoParagraph' => false
                                                ],
                                                'preset' => 'custom',
                                            ]) ?>

                                            <?= $form->field($model, "mainPageAppartement" . "[" . $language['language_id'] . "]")->widget(CKEditor::className(), [
                                                'options' => [
                                                    'rows' => 6,
                                                ],
                                                'clientOptions' => [
                                                    'allowedContent' => true,
                                                    'fillEmptyBlocks' => false,
                                                    'autoParagraph' => false
                                                ],
                                                'preset' => 'custom',
                                            ]) ?>

                                            <?= $form->field($model, "mainPageConfidence" . "[" . $language['language_id'] . "]")->widget(CKEditor::className(), [
                                                'options' => [
                                                    'rows' => 6,
                                                ],
                                                'clientOptions' => [
                                                    'allowedContent' => true,
                                                    'fillEmptyBlocks' => false,
                                                    'autoParagraph' => false
                                                ],
                                                'preset' => 'custom',
                                            ]) ?>

                                            <?= $form->field($model, "mainPageApplication" . "[" . $language['language_id'] . "]")->widget(CKEditor::className(), [
                                                'options' => [
                                                    'rows' => 6,
                                                ],
                                                'clientOptions' => [
                                                    'allowedContent' => true,
                                                    'fillEmptyBlocks' => false,
                                                    'autoParagraph' => false
                                                ],
                                                'preset' => 'custom',
                                            ]) ?>

                                            <?= $form->field($model, "mainPageOperations" . "[" . $language['language_id'] . "]")->widget(CKEditor::className(), [
                                                'options' => [
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
                    </fieldset>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="pages">
                <div class="box-body">
                    <fieldset>
                        <legend>Отзывы клиентов</legend>

                        <?= $form->field($model, 'reviewsPageId')->dropDownList(Page::getList()) ?>

                    </fieldset>

                    <fieldset>
                        <legend>FAQ</legend>

                        <?= $form->field($model, 'faqPageId')->dropDownList(Page::getList()) ?>

                    </fieldset>

                    <fieldset>
                        <legend>О компании</legend>

                            <?= $form->field($model, 'aboutPageId')->dropDownList(Page::getList()) ?>

                    </fieldset>

                    <fieldset>
                        <legend>Контакты</legend>

                        <?= $form->field($model, 'contactsPageId')->dropDownList(Page::getList()) ?>

                    </fieldset>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="mail">
                <div class="box-body">

                    <?= $form->field($model, 'adminEmail')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'supportEmail')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        </div>

    </div>
    <div class="box-footer">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
$this->registerJs(
    "
    $('#setting a:first').tab('show');
    $('#setting-slogan a:first').tab('show');
    $('#setting-address a:first').tab('show');
    $('#setting-main-page-carousel-descr a:first').tab('show');
    $('#setting-product-page-payment-delivery-descr a:first').tab('show');
    ",
    View::POS_READY,
    'script'
);
?>