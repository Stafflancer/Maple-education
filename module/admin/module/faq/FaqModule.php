<?php
/**
 * FaqModule class file.
 */

namespace app\module\admin\module\faq;

use Yii;

/**
 * Class FaqModule.
 *
 * @package app\module\admin
 */
class FaqModule extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\module\admin\module\faq\controllers';
    /**
     * @inheritdoc
     */
    public $layout = '@app/module/admin/views/layouts/main';


    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->defaultRoute = 'faq';

        parent::init();
    }
}
