<?php
/**
 * DesignController class file.
 */

namespace app\module\admin\controllers;

use Yii;
use app\module\admin\models\Module;
use app\components\ImageBehavior;
use app\module\admin\models\User;
use app\module\admin\models\Language;
use app\module\admin\models\DesignForm;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\UploadedFile;

/**
 * SettingController implements the CRUD actions for SettingForm model.
 */
class DesignController extends Controller
{
    const MAIN_COLOR = '#1aa79b';
    const ADDITIONAL_COLOR = '#e11356';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => false,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            /** @var User $identity */
                            $identity = Yii::$app->user->identity;

                            return $identity->isUser;
                        },
                        'denyCallback' => function ($rule, $action) {
                            $this->redirect('/');
                        },
                    ], [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all design settings.
     *
     * @return mixed index view
     */
    public function actionIndex()
    {
        $file = __DIR__ . '/../../../config/design.inc';

        $content = file_get_contents($file);
        $array = unserialize(base64_decode($content));

        $model = new DesignForm();
        $model->setAttributes($array, false);

        $languages = Language::getAll(Language::STATUS_ACTIVE);

        foreach ($languages as $language) {
            if (!isset($model->logo[$language['language_id']])) {
                $model->logo[$language['language_id']] = '';
            }
        }

        if ($model->load(Yii::$app->request->post())) {
            // Save favicon
            $model->faviconFile = UploadedFile::getInstance($model, 'faviconFile');

            if ($model->faviconFile !== null) {
                $model->favicon = $model->uploadImage('faviconFile');
            }

            // Save logo files
            foreach ($languages as $language) {
                $model->logoFile[$language['language_id']] = UploadedFile::getInstance($model, 'logoFile[' . $language['language_id'] . ']');

                if ($model->logoFile[$language['language_id']]) {
                    $model->logo[$language['language_id']] = $model->uploadImage('logoFile', $language['language_id']);
                }

                unset($model->logoFile[$language['language_id']]);
            }

            $string = base64_encode(serialize($model->getAttributes()));
            file_put_contents($file, $string);
            Yii::$app->session->setFlash('success', 'Настройки успешно сохранены.');
        }

        $placeholder = ImageBehavior::placeholder(100, 100);

        return $this->render('index', [
            'model' => $model,
            'languages' => $languages,
            'placeholder' => $placeholder,
        ]);
    }
}
