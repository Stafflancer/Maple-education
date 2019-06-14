<?php
/**
 * Faq page view.
 */

/* @var $this yii\web\View */
/* @var $page array */
/* @var $defaultPage array */
/* @var $faq array */
/* @var $model \app\models\ContactForm */

use app\module\admin\models\Language;
use app\widgets\ClientRequestPopup;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->params['bodyClass'] = '';

$languageId = Language::getLanguageIdByCode(Yii::$app->language);
$defaultLanguageId = Language::getLanguageIdByCode(Yii::$app->urlManager->getDefaultLanguage());

$this->title = $page['meta_title'] ? $page['meta_title'] : $defaultPage['meta_title'];

$metaDescription = $page['meta_description'] ? $page['meta_description'] : $defaultPage['meta_description'];
$metaKeywords = $page['meta_keyword'] ? $page['meta_keyword'] : $defaultPage['meta_keyword'];

if ($metaDescription) {
    $this->registerMetaTag([
        'name' => 'description',
        'content' => $metaDescription,
    ]);
}
if ($metaKeywords) {
    $this->registerMetaTag([
        'name' => 'keywords',
        'content' => $metaKeywords,
    ]);
}

?>
<div class="faq" data-anim="group" data-section="">
    <div class="buble-img" data-anim="stagger-element" data-anim-element-delay="1">
        <img src="<?= Url::to('/static/img/faq-bubles/1.png') ?>" alt="">
    </div>
    <div class="inner">
        <h1 class="title-h1 faq__title" data-anim="stagger-items" data-anim-element-delay="0.5"> <?= Yii::t('faq', 'Здесь мы отобрали часто задаваемые вопросы и ответили на них') ?> </h1>
    </div>
</div>
<div class="tabs faq-tabs">
    <div class="tabs__in inner">
        <div class="tabs__container" data-tabs>
            <div class="tabs__btns" data-anim="group">
                <?php $index = 0; ?>
                <?php foreach ($faq as $key => $faqItem): ?>
                <div class="tabs-btn<?= ($index == 0) ? ' is-active' : '' ?>" data-tab="<?= $key ?>" data-anim="stagger-element" data-anim-element-delay="<?= $index ?>">
                    <span> <?= $faqItem['name'] ?> <span class="tabs-btn__line"><span class="tabs-btn__line-inner"></span></span></span>
                </div>
                <?php $index += 0.5 ?>
                <?php endforeach; ?>
            </div>
            <div class="tabs__content">
                <?php foreach ($faq as $key => $faqItem): ?>
                <div class="tabs-item <?= ($key == 0) ? ' is-active' : '' ?>" data-content="<?= $key ?>">
                    <div class="accordeon " data-accordeon data-anim="group">
                        <?php $index = 0; ?>
                        <?php foreach ($faqItem['faq'] as $key2 => $faqQuestion): ?>
                        <div class="accordeon__item js-accordeon-item" data-anim="stagger-element" data-anim-element-delay="<?= $index ?>">
                            <div class="accordeon__btn btn-accordeon js-accordeon-btn">
                                <div class="btn-accordeon__in"></div>
                            </div>
                            <div class="accordeon__content">
                                <div class="accordeon__title"> <?= $faqQuestion['question'] ?></div>
                                <div class="accordeon__text js-accordeon-text"><?= $faqQuestion['answer'] ?></div>
                            </div>
                        </div>
                        <?php $index += 0.5 ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<div class="faq-questions">
    <div class="buble-img" data-anim="group"><img src="<?= Url::to('/static/img/faq-bubles/2.png') ?>" alt="alt" data-anim="stagger-element"></div>
    <div class="inner inner_mob" data-anim="group">
        <div class="pull-left">
            <h2 class="title-h2" data-anim="stagger-element" data-anim-element-delay="1"> <?= Yii::t('faq', 'Не нашли вопрос?') ?> </h2>
        </div>
        <div class="clr">
            <div class="faq-questions__form form js-blur-container">
                <?php $form = ActiveForm::begin([
                    'options' => [
                        'class' => 'js-form send-request-js',
                        'method' => 'post',
                        'data-onsubmit-text' => Yii::t('faq', 'Ваш вопрос успешно отправлен')
                    ]
                ]); ?>
                    <div class="faq-questions__container">
                        <div class="faq-questions__thanks js-thanks">
                            <div class="title-h1"><?= Yii::t('faq', 'Спасибо!') ?></div>
                        </div>
                    </div>
                    <div class="faq-questions__blur js-blur">
                        <p class="faq-questions__title" data-anim="stagger-element" data-anim-element-delay="1"> <?= Yii::t('faq', 'Напишите его и мы ответим') ?> </p>
                        <div class="form__inner">
                            <?= $form->field($model, 'name', [
                                    'options' => [
                                        'class' => 'form-group form-group_left js-form-group',
                                        'data-anim' => 'stagger-element',
                                        'data-anim-element-delay' => '1'
                                    ],
                                    'template' => "{input}\n{label}\n{hint}\n{error}"
                                ])->textInput([
                                    'class' => 'form-control js-input',
                                ]);
                            ?>

                            <?= $form->field($model, 'email', [
                                'options' => [
                                    'class' => 'form-group form-group_right js-form-group',
                                    'data-anim' => 'stagger-element',
                                    'data-anim-element-delay' => '1'
                                ],
                                'template' => "{input}\n{label}\n{hint}\n{error}"
                            ])->textInput([
                                'class' => 'form-control js-input',
                            ]);
                            ?>

                            <?= $form->field($model, 'message', [
                                'options' => [
                                    'class' => 'form-group js-form-group js-form-group',
                                    'data-anim' => 'stagger-element',
                                    'data-anim-element-delay' => '1'
                                ],
                                'template' => "{input}\n{label}\n{hint}\n{error}"
                            ])->textInput([
                                'class' => 'form-control js-input',
                            ]);
                            ?>
                        </div>

                        <?= Html::submitButton(Yii::t('faq', 'Отправить вопрос'), [
                            'class' => 'btn btn_submit js-submit',
                            'data-anim' => 'stagger-element',
                            'data-anim-element-delay' => '1.4',
                            'data-success-text' => Yii::t('faq', 'Спасибо вам!'),
                            'data-hover' => Yii::t('faq', 'Отправить вопрос'),
                        ]) ?>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
<?= ClientRequestPopup::widget() ?>
