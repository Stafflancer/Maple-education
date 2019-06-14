<?php
/**
 * LanguagePicker widget class file.
 */

namespace app\widgets;

use app\module\admin\models\Language;
use Yii;
use yii\base\Widget;

/**
 * Language Picker widget.
 *
 * @package app\widgets
 */
class LanguagePicker extends Widget
{
    /** @var array $languages languages data */
    public $languages;

    /** @var array $_labels language labels  */
    private static $_labels;

    public $ulCssClass = 'lang js-lang-default';
    public $liCssClass = 'lang__item js-lang-item';
    public $textCssClass = 'lang__text js-lang-drop-text';


    /**
     * @inheritdoc
     */
    public function init()
    {
        $route = Yii::$app->controller->route;
        $params = $_GET;

        array_unshift($params, '/' . $route);

        foreach (Yii::$app->urlManager->languages as $language) {
            $isWildcard = substr($language, -2) === '-*';
            if ($isWildcard) {
                $language = substr($language, 0, 2);
            }
            $params['language'] = $language;
            $this->languages[] = [
                'label' => self::label($language),
                'code' => $language,
                'url' => $params,
            ];
        }

        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        return $this->render('languagePicker', [
            'languages' => $this->languages,
            'ulCssClass' => $this->ulCssClass,
            'liCssClass' => $this->liCssClass,
            'textCssClass' => $this->textCssClass,
        ]);
    }

    /**
     * Returns label by language code.
     *
     * @param string $code language code
     * @return mixed language label
     */
    public static function label($code)
    {
        if (self::$_labels === null) {
            $languages = Language::getAll(Language::STATUS_ACTIVE);

            foreach ($languages as $language) {
                self::$_labels[$language['code']] = mb_substr($language['name'], 0, 3);
            }
        }

        return isset(self::$_labels[$code]) ? self::$_labels[$code] : null;
    }
}
