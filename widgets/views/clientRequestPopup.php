<?php
/**
 * Client request popup widget view.
 */

use app\module\admin\module\request\models\Request;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $clientRequestAdvancedForm app\models\ClientRequestAdvancedForm */
?>
<div class="popup-overlay js-popup-overlay">
    <div class="popup-bg js-popup-bg"></div>
    <div class="popup">
        <div class="popup__in inner">
            <div class="popup__thanks thanks">
                <h3 class="title-h1"><?= Yii::t('faq', 'Спасибо!') ?></h3>
            </div>
            <button class="popup__close js-close-popup">
                <span class="btn-line"></span><span class="btn-text-hover"><?= Yii::t('request-popup', 'НАЗАД!') ?></span><span class="btn-line btn-line_big"></span>
            </button>
            <div class="popup-form">
                <h2 class="popup-form__title title"> <?= Yii::t('request-popup', 'Отправьте заявку и мы перезвоним.') ?> </h2>
                <div class="popup-form__descr"> <?= Yii::t('request-popup', 'Познакомимся, расскажем детальнее о программе, а также ответим на ваши вопросы.') ?></div>
                <div class="form">
                    <?php $form = ActiveForm::begin([
                        'options' => [
                            'class' => 'send-request-js',
                            'method' => 'post',
                        ],
                        'action' => Url::to(['site/request'])
                    ]); ?>
                        <div class="form__inner">

                            <?= $form->field($clientRequestAdvancedForm, 'name', [
                                'options' => [
                                    'class' => 'form-group form-group_left js-form-group',
                                ],
                                'template' => "{input}\n{label}\n{hint}\n{error}"
                            ])->textInput([
                                'class' => 'form-control js-input',
                            ]);
                            ?>

                            <?= $form->field($clientRequestAdvancedForm, 'phone', [
                                'options' => [
                                    'class' => 'form-group form-group_right js-form-group',
                                ],
                                'template' => "{input}\n{label}\n{hint}\n{error}"
                            ])->widget(MaskedInput::class, [
                                'mask' => "+999-99-999-9999",
                                'options' => [
                                    'class' => 'form-control js-input',
                                ],
                                'clientOptions' => [
                                    'showMaskOnHover' => false,
                                ],
                            ]);
                            ?>

                            <?= $form->field($clientRequestAdvancedForm, 'email', [
                                'options' => [
                                    'class' => 'form-group form-group_left js-form-group',
                                ],
                                'template' => "{input}\n{label}\n{hint}\n{error}"
                            ])->textInput([
                                'class' => 'form-control js-input',
                            ]);
                            ?>

                            <?= $form->field($clientRequestAdvancedForm, 'education', [
                                'options' => [
                                    'class' => 'form-group form-group_right js-form-group',
                                ],
                                'template' => "{input}\n{label}\n{hint}\n{error}"
                            ])->textInput([
                                'class' => 'form-control js-input',
                            ]);
                            ?>

                        </div>

                        <?= $form->field($clientRequestAdvancedForm, 'english_level', [
                            'options' => [
                                'class' => 'form-group form-group_left form-group_select',
                            ],
                            'template' => "{label}\n{input}\n{hint}\n{error}"
                        ])->dropDownList(Request::getEnglishLevelsList(), [
                            'class' => 'form-control js-input',
                            'data-select' => '',
                            'data-mod' => 'select-wrap_popup'
                        ])->label($clientRequestAdvancedForm->getAttributeLabel('english_level'), [
                            'class' => 'popup-form__lbl popup-form__lbl_pl'
                        ]) ?>

                        <?= $form->field($clientRequestAdvancedForm, 'birthday_date', [
                            'options' => [
                                'class' => 'form-group form-group_right form-group_select',
                            ],
                            'template' => Request::getDatePickerTemplate()
                        ])->hiddenInput([
                            'class' => 'date-picker-DatePicker2',
                        ])
                        ->label($clientRequestAdvancedForm->getAttributeLabel('birthday_date'), [
                            'class' => 'popup-form__lbl'
                        ]) ?>

                        <?= Html::submitButton(Yii::t('main', 'Оставить заявку'), [
                            'class' => 'btn btn_submit',
                            'data-success-text' => Yii::t('faq', 'Спасибо!'),
                            'data-hover' => Yii::t('main', 'Оставить заявку'),
                        ]) ?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
