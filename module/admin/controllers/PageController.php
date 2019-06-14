<?php
/**
 * PageController class file.
 */

namespace app\module\admin\controllers;

use Yii;
use app\module\admin\models\User;
use app\module\admin\models\Language;
use app\module\admin\models\PageDescription;
use app\module\admin\models\SeoUrl;
use app\module\admin\models\Page;
use app\module\admin\models\PageSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PageController implements the CRUD actions for Page model.
 */
class PageController extends Controller
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
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Page models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Page model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     *
     * @return mixed create view
     */
    public function actionCreate()
    {
        $page = new Page();

        $descriptions = [];
        $seoUrls = [];

        $languages = Language::getAll(Language::STATUS_ACTIVE);

        foreach ($languages as $language) {
            $description = new PageDescription();
            $seoUrl = new SeoUrl();

            if ($language['language_id'] == Language::getLanguageIdByCode(Yii::$app->language)) {
                $description->scenario = 'language-is-system';
            }

            $descriptions[$language['language_id']] = $description;
            $seoUrls[$language['language_id']] = $seoUrl;
        }

        if ($page->load(Yii::$app->request->post()) && PageDescription::loadMultiple($descriptions, Yii::$app->request->post())
            && SeoUrl::loadMultiple($seoUrls, Yii::$app->request->post())) {

            $isValid = $page->validate();

            $isValid = PageDescription::validateMultiple($descriptions, Yii::$app->request->post()) && $isValid;
            $isValid = SeoUrl::validateMultiple($seoUrls, Yii::$app->request->post()) && $isValid;

            if ($isValid && $page->save(false)) {
                // Save descriptions
                foreach ($descriptions as $key => $description) {
                    $description->page_id = $page->page_id;
                    $description->language_id = $key;
                    $description->save(false);
                }

                // Save SEO URLs
                $pageName = $descriptions[Language::getLanguageIdByCode(Yii::$app->language)]->title;

                /**
                 * @var int $key language id
                 * @var SeoUrl  $seoUrl category SEO URL
                 */
                foreach ($seoUrls as $key => $seoUrl) {
                    $seoUrl->language_id = $key;
                    $seoUrl->query = 'page_id=' . $page->page_id;
                    $seoUrl->keyword = SeoUrl::prepare(SeoUrl::transliterate($pageName), $key);

                    $seoUrl->save(false);
                }

                return $this->redirect(['index']);
            }
        }

        if (empty($page->sort_order)) {
            $page->sort_order = 1;
        }

        return $this->render('create', [
            'page' => $page,
            'descriptions' => $descriptions,
            'seoUrls' => $seoUrls,
            'languages' => $languages,
        ]);
    }

    /**
     * Updates an existing Page model.
     * If update is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id page ID
     * @return mixed update view
     * @throws NotFoundHttpException if model not found
     */
    public function actionUpdate($id)
    {
        $page = $this->findModel($id);

        $descriptions = [];
        $seoUrls = [];

        $languages = Language::getAll(Language::STATUS_ACTIVE);

        foreach ($languages as $language) {
            $description = PageDescription::findOne([
                'page_id' => $page->page_id,
                'language_id' => $language['language_id']
            ]);

            $seoUrl = SeoUrl::findOne([
                'query' => 'page_id=' . $page->page_id,
                'language_id' => $language['language_id']
            ]);

            $descriptions[$language['language_id']] = (!empty($description)) ? $description : new PageDescription();
            $seoUrls[$language['language_id']] = (!empty($seoUrl)) ? $seoUrl : new SeoUrl();

            if ($language['language_id'] == Language::getLanguageIdByCode(Yii::$app->language)) {
                $descriptions[$language['language_id']]->scenario = 'language-is-system';
            }
        }

        if ($page->load(Yii::$app->request->post()) && PageDescription::loadMultiple($descriptions, Yii::$app->request->post())
            && SeoUrl::loadMultiple($seoUrls, Yii::$app->request->post())) {

            $isValid = $page->validate();

            $isValid = PageDescription::validateMultiple($descriptions, Yii::$app->request->post()) && $isValid;
            $isValid = SeoUrl::validateMultiple($seoUrls, Yii::$app->request->post()) && $isValid;

            if ($isValid && $page->save(false)) {
                // Update descriptions
                foreach ($descriptions as $key => $description) {
                    $description->page_id = $page->page_id;
                    $description->language_id = $key;
                    $description->save(false);
                }

                // Update SEO URLs
                $pageName = $descriptions[Language::getLanguageIdByCode(Yii::$app->language)]->title;

                /**
                 * @var int $key language id
                 * @var SeoUrl  $seoUrl category SEO URL
                 */
                foreach ($seoUrls as $key => $seoUrl) {
                    $seoUrl->language_id = $key;
                    $seoUrl->query = 'page_id=' . $page->page_id;

                    if (empty($seoUrl->keyword)) {
                        $seoUrl->keyword = SeoUrl::prepare(SeoUrl::transliterate($pageName), $key);
                    }

                    $seoUrl->save(false);
                }

                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'page' => $page,
            'descriptions' => $descriptions,
            'seoUrls' => $seoUrls,
            'languages' => $languages,
        ]);
    }

    /**
     * Deletes an existing Page model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id Page id
     * @return mixed response object
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Exception|\Throwable in case delete failed.
     * @throws \yii\db\StaleObjectException if [[optimisticLock|optimistic locking]] is enabled and the data
     * being deleted is outdated.
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        SeoUrl::removeByQuery('page_id=' . $id);
        PageDescription::removeByPageId($id);

        return $this->redirect(['index']);
    }

    /**
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id Page ID
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Page::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая страница не существует.');
        }
    }
}
