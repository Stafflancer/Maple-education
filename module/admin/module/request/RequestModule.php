<?php
/**
 * RequestModule class file.
 */

namespace app\module\admin\module\request;

/**
 * Class RequestModule.
 *
 * @package app\module\admin
 */
class RequestModule extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\module\admin\module\request\controllers';
    /**
     * @inheritdoc
     */
    public $layout = '@app/module/admin/views/layouts/main';


    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->defaultRoute = 'request';

        parent::init();
    }
}
