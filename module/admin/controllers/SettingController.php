<?php
/**
 * SettingController class file.
 */

namespace app\module\admin\controllers;

use Yii;
use app\module\admin\models\User;
use app\module\admin\models\Language;
use app\module\admin\models\SettingForm;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * SettingController implements the CRUD actions for SettingForm model.
 */
class SettingController extends Controller
{
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
     * Lists all settings.
     *
     * @return mixed index view
     */
    public function actionIndex()
    {
        $file = __DIR__ . '/../../../config/params.inc';

        $content = file_get_contents($file);
        $array = unserialize(base64_decode($content));

        $model = new SettingForm();
        $model->setAttributes($array);

        $languages = Language::getAll(Language::STATUS_ACTIVE);

        if ($model->load(Yii::$app->request->post())) {
            $string = base64_encode(serialize($model->getAttributes()));
            file_put_contents($file, $string);
            Yii::$app->session->setFlash('success', 'Настройки успешно сохранены.');
        }

        return $this->render('index', [
            'model' => $model,
            'languages' => $languages,
        ]);
    }
}
