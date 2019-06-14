<?php
/**
 * AdminModule class file.
 */

namespace app\module\admin;

use Yii;
use app\module\admin\models\Module;
use yii\helpers\ArrayHelper;

/**
 * Class AdminModule.
 *
 * @package app\module\admin
 */
class AdminModule extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\module\admin\controllers';
    /**
     * @inheritdoc
     */
    public $layout = 'main';


    /**
     * @inheritdoc
     */
    public function init()
    {
        Yii::$app->homeUrl = '/admin';
        Yii::$app->errorHandler->errorAction = 'admin/default/error';

        $this->modules = self::getChildModules();

        parent::init();
    }

    /**
     * Return child modules.
     *
     * @return array child modules.
     */
    public static function getChildModules()
    {
        $result = [];

        $modules = Module::find()->where(['status' => Module::STATUS_ACTIVE])->orderBy('sort_order ASC')->all();

        /** @var Module $module */
        foreach ($modules as $module) {
            $result[$module->name] = [
                'class' => "app\\module\\admin\\module\\$module->name\\" . ucfirst($module->name) . "Module",
            ];

        }

        return $result;
    }


    /**
     * Returns main menu items. This method merges static menu items with modules menu items.
     *
     * @return array
     */
    public static function getMenuItems()
    {
        $basicItems = [
            ['label' => 'МЕНЮ', 'options' => ['class' => 'header']],
            ['label' => 'Панель состояния', 'icon' => 'dashboard', 'url' => ['/admin']],
        ];

        $moduleItems = self::getModulesMenuItems();

        return ArrayHelper::merge($basicItems, $moduleItems, [
            ['label' => 'Обратная связь', 'icon' => 'comments-o', 'url' => ['/admin/feedback']],
            ['label' => 'Страницы', 'icon' => 'newspaper-o', 'url' => ['/admin/page']],
            ['label' => 'Баннеры', 'icon' => 'file-image-o', 'url' => ['/admin/banner']],
            ['label' => 'Пользователи', 'icon' => 'users', 'url' => ['/admin/user']],
            ['label' => 'Модули', 'icon' => 'puzzle-piece', 'url' => ['/admin/module']],
            [
                'label' => 'Настройки',
                'icon' => 'cogs',
                'items' => [
                    ['label' => 'Общие', 'icon' => 'wrench', 'url' => ['/admin/setting']],
                    ['label' => 'Дизайн', 'icon' => 'paint-brush', 'url' => ['/admin/design']],
                    ['label' => 'Языки', 'icon' => 'language', 'url' => ['/admin/language']],
                    ['label' => 'Переводы', 'icon' => 'globe', 'url' => ['/admin/source-message']],
                    ['label' => 'SEO URL', 'icon' => 'link', 'url' => ['/admin/seo-url']],
                ],
            ]
        ]);
    }

    /**
     * Returns modules menu items array.
     *
     * @return array modules menu items
     */
    public static function getModulesMenuItems()
    {
        $items = [];

        $modules = Module::find()->where(['status' => Module::STATUS_ACTIVE])->orderBy('sort_order ASC')->all();

        /** @var Module $module */
        foreach ($modules as $module) {
            $moduleItems = self::getModuleMenuItems($module->name);

            $items[] = $moduleItems;

        }

        return $items;
    }

    /**
     * Returns module menu items.
     *
     * @param string $moduleName module name
     * @return array module menu items
     */
    public static function getModuleMenuItems($moduleName)
    {
        $moduleInfo = Module::getModuleInfo($moduleName);

        return isset($moduleInfo['menu']) ? $moduleInfo['menu'] : [];
    }
}
