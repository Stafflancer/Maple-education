<?php
/**
 * ReviewModule class file.
 */

namespace app\module\admin\module\review;

use Yii;

/**
 * Class ReviewModule.
 *
 * @package app\module\admin
 */
class ReviewModule extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\module\admin\module\review\controllers';
    /**
     * @inheritdoc
     */
    public $layout = '@app/module/admin/views/layouts/main';


    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->defaultRoute = 'review';

        parent::init();
    }
}
