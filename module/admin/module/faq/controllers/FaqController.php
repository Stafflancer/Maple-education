<?php
/**
 * FaqController class file.
 */

namespace app\module\admin\module\faq\controllers;

use Yii;
use app\module\admin\models\Language;
use app\module\admin\models\User;
use app\module\admin\module\faq\models\FaqDescription;
use app\module\admin\module\faq\models\Faq;
use app\module\admin\module\faq\models\FaqSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FaqController implements the CRUD actions for Faq model.
 */
class FaqController extends Controller
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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Faq models.
     *
     * @return mixed index view
     */
    public function actionIndex()
    {
        $searchModel = new FaqSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Faq model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     *
     * @return mixed create view
     */
    public function actionCreate()
    {
        /** @var Faq $faq */
        $faq = new Faq();

        $descriptions = [];

        $languages = Language::getAll(Language::STATUS_ACTIVE);

        foreach ($languages as $language) {
            $description = new FaqDescription();

            if ($language['language_id'] == Language::getLanguageIdByCode(Yii::$app->language)) {
                $description->scenario = 'language-is-system';
            }

            $descriptions[$language['language_id']] = $description;
        }

        if ($faq->load(Yii::$app->request->post()) && FaqDescription::loadMultiple($descriptions, Yii::$app->request->post())) {
            $isValid = $faq->validate();

            $isValid = FaqDescription::validateMultiple($descriptions, Yii::$app->request->post()) && $isValid;

            if ($isValid && $faq->save(false)) {
                // Save descriptions
                foreach ($descriptions as $key => $description) {
                    $description->faq_id = $faq->faq_id;
                    $description->language_id = $key;
                    $description->save(false);
                }

                return $this->redirect(['index']);
            }
        }

        if (empty($faq->sort_order)) {
            $faq->sort_order = 1;
        }

        return $this->render('create', [
            'faq' => $faq,
            'descriptions' => $descriptions,
            'languages' => $languages,
        ]);
    }

    /**
     * Updates an existing Faq model.
     * If update is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id Faq id
     * @return mixed update view
     * @throws NotFoundHttpException if model not found
     */
    public function actionUpdate($id)
    {
        /** @var Faq $faq */
        $faq = $this->findModel($id);

        $descriptions = [];

        $languages = Language::getAll(Language::STATUS_ACTIVE);

        foreach ($languages as $language) {
            $description = FaqDescription::findOne([
                'faq_id' => $faq->faq_id,
                'language_id' => $language['language_id']
            ]);

            $descriptions[$language['language_id']] = (!empty($description)) ? $description : new FaqDescription();

            if ($language['language_id'] == Language::getLanguageIdByCode(Yii::$app->language)) {
                $descriptions[$language['language_id']]->scenario = 'language-is-system';
            }
        }

        if ($faq->load(Yii::$app->request->post()) && FaqDescription::loadMultiple($descriptions, Yii::$app->request->post())) {
            $isValid = $faq->validate();

            $isValid = FaqDescription::validateMultiple($descriptions, Yii::$app->request->post()) && $isValid;

            if ($isValid && $faq->save(false)) {
                // Update descriptions
                foreach ($descriptions as $key => $description) {
                    $description->faq_id = $faq->faq_id;
                    $description->language_id = $key;
                    $description->save(false);
                }

                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'faq' => $faq,
            'descriptions' => $descriptions,
            'languages' => $languages,
        ]);
    }

    /**
     * Deletes an existing Faq model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id model id
     * @return mixed response object
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Exception|\Throwable in case delete failed.
     * @throws \yii\db\StaleObjectException if [[optimisticLock|optimistic locking]] is enabled and the data
     * being deleted is outdated.
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        FaqDescription::removeByFaqId($id);

        return $this->redirect(['index']);
    }

    /**
     * Finds the Faq model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id model id
     * @return Faq the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Faq::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрашиваемая страница не существует.');
    }
}
