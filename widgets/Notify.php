<?php
/**
 * Notify widget class file.
 */

namespace app\widgets;

use Yii;

/**
 * Notify widget renders a message from session flash. All flash messages are displayed
 * in the sequence they were assigned using setFlash. You can set message as following:
 *
 * ```php
 * Yii::$app->session->setFlash('error', 'This is the message');
 * Yii::$app->session->setFlash('success', 'This is the message');
 * Yii::$app->session->setFlash('info', 'This is the message');
 * ```
 *
 * Multiple messages could be set as follows:
 *
 * ```php
 * Yii::$app->session->setFlash('error', ['Error 1', 'Error 2']);
 * ```
 */
class Notify extends yii\base\Widget
{
    /**
     * @var array the alert types configuration for the flash messages.
     * This array is setup as $key => $value, where:
     * - key: the name of the session flash variable
     * - value: the bootstrap alert type (i.e. danger, success, info, warning)
     */
    public $alertTypes = [
        'error'   => 'form-alert--danger',
        'danger'  => 'form-alert--danger',
        'success' => 'form-alert--success',
        'info'    => 'form-alert--info',
        'warning' => 'form-alert--warning'
    ];


    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $session = Yii::$app->session;
        $flashes = $session->getAllFlashes();


        foreach ($flashes as $type => $flash) {
            if (!isset($this->alertTypes[$type])) {
                continue;
            }

            foreach ((array) $flash as $i => $message) {
                echo $this->render('notify', [
                    'body' => $message,
                    'id' => $this->getId() . '-' . $type . '-' . $i,
                    'class' => $this->alertTypes[$type],
                ]);
            }

            $session->removeFlash($type);
        }
    }
}
