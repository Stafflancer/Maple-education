<?php
/**
 * Phones widget class file.
 */

namespace app\widgets;

use Yii;
use yii\base\Widget;

/**
 * Phones widget.
 *
 * @package app\widgets
 */
class Phones extends Widget
{
    /**
     * @inheritdoc
     */
    public function run()
    {
        $phones = isset(Yii::$app->params['phones']) ? explode(PHP_EOL, Yii::$app->params['phones']) : null;

        return $this->render('phones', [
            'phones' => $phones,
        ]);
    }
}
