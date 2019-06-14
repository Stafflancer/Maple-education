<?php
/**
 * ClientRequestPopup widget class file.
 */

namespace app\widgets;

use app\models\ClientRequestAdvancedForm;
use yii\base\Widget;

/**
 * ClientRequestPopup widget.
 *
 * @package app\widgets
 */
class ClientRequestPopup extends Widget
{
    /**
     * @inheritdoc
     */
    public function run()
    {
        $clientRequestAdvancedForm = new ClientRequestAdvancedForm();

        return $this->render('clientRequestPopup', [
            'clientRequestAdvancedForm' => $clientRequestAdvancedForm
        ]);
    }
}
