<?php
/**
 * Contacts widget class file.
 */

namespace app\widgets;

use Yii;
use yii\base\Widget;

/**
 * Contacts widget.
 *
 * @package app\widgets
 */
class Contacts extends Widget
{
    /**
     * @inheritdoc
     */
    public function run()
    {
        $email = isset(Yii::$app->params['email']) ? Yii::$app->params['email'] : null;
        $phones = isset(Yii::$app->params['phones']) ? explode(PHP_EOL, Yii::$app->params['phones']) : null;

        return $this->render('contacts', [
            'email' => $email,
            'phones' => $phones,
        ]);
    }
}
