<?php
/**
 * SiteController class file.
 */

namespace app\controllers;

use Yii;
use app\models\ClientRequestAdvancedForm;
use app\models\ClientRequestForm;
use app\models\ContactForm;
use app\module\admin\module\faq\models\Faq;
use app\module\admin\module\review\models\Review;
use app\module\admin\models\Language;
use app\module\admin\models\Page;
use app\module\admin\models\SeoUrl;
use yii\base\InvalidConfigException;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Main site controller.
 *
 * @package app\controllers
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'layout' => 'static'
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string home page rendering result
     * @throws NotFoundHttpException if page not found
     */
    public function actionIndex()
    {
        $mainPageId = isset(Yii::$app->params['mainPageId']) ? Yii::$app->params['mainPageId'] : null;

        if ($mainPageId === null) {
            throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
        }

        $languageId = Language::getLanguageIdByCode(Yii::$app->language);
        $defaultLanguageId = Language::getLanguageIdByCode(Yii::$app->urlManager->getDefaultLanguage());

        $page = Page::getByIdAndLanguageId($mainPageId, $languageId);

        if ($languageId != $defaultLanguageId) {
            $defaultPage = Page::getByIdAndLanguageId($mainPageId, $defaultLanguageId);
        } else {
            $defaultPage = $page;
        }

        $reviews = Review::getAll(Review::STATUS_ACTIVE, 3);

        $clientRequestForm = new ClientRequestForm();

        if ($clientRequestForm->load(Yii::$app->request->post()) && $clientRequestForm->send(Yii::$app->params['adminEmail'])) {
            return $this->asJson("Success!");
        }

        $params = [
            'page' => $page,
            'defaultPage' => $defaultPage,
            'reviews' => $reviews,
            'clientRequestForm' => $clientRequestForm,
        ];

        return $this->render('index', $params);
    }

    /**
     * Request action.
     *
     * @return \yii\web\Response response object
     * @throws NotFoundHttpException if page not found
     */
    public function actionRequest()
    {
        if (Yii::$app->request->isPost) {
            $clientRequestForm = new ClientRequestAdvancedForm();

            if ($clientRequestForm->load(Yii::$app->request->post()) && $clientRequestForm->send(Yii::$app->params['adminEmail'])) {
                return $this->asJson("Success!");
            }
        } else {
            throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
        }
    }

    /**
     * Displays static page.
     *
     * @return string the rendering result.
     * @throws NotFoundHttpException if page not found
     */
    public function actionPage()
    {
        $this->view->params['header_inner_class'] = 'page-header--inner';

        try {
            $alias = Yii::$app->request->getPathInfo();
        } catch (InvalidConfigException $e) {
            throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
        }

        $languageId = Language::getLanguageIdByCode(Yii::$app->language);
        $defaultLanguageId = Language::getLanguageIdByCode(Yii::$app->urlManager->getDefaultLanguage());

        $seoUrl = SeoUrl::findOne(['keyword' => $alias, 'language_id' => $languageId]);

        if (!empty($seoUrl)) {
            if ((strncmp('page_id=', $seoUrl->query, 8) === 0)) {
                return $this->renderStaticPage($alias, (int)substr($seoUrl->query, 8), $languageId, $defaultLanguageId);
            }
        } else {
            throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
        }
    }

    /**
     * Renders static page.
     *
     * @param string $alias page SEO URL
     * @param int $pageId page id
     * @param int $languageId language id
     * @param int $defaultLanguageId default language id
     * @return string|\yii\web\Response page content
     * @throws NotFoundHttpException if page not found
     */
    protected function renderStaticPage($alias, $pageId,  $languageId, $defaultLanguageId)
    {
        $this->layout = 'static';

        $reviewsPageId = isset(Yii::$app->params['reviewsPageId']) ? Yii::$app->params['reviewsPageId'] : null;
        $faqPageId = isset(Yii::$app->params['faqPageId']) ? Yii::$app->params['faqPageId'] : null;
        $aboutPageId = isset(Yii::$app->params['aboutPageId']) ? Yii::$app->params['aboutPageId'] : null;
        $contactsPageId = isset(Yii::$app->params['contactsPageId']) ? Yii::$app->params['contactsPageId'] : null;

        if (!$pageId && $languageId != $defaultLanguageId) {
            $pageId = SeoUrl::getQueryModelId('page_id', $alias, $defaultLanguageId);
        }

        if (!$pageId) {
            throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
        }

        $page = Page::getByIdAndLanguageId($pageId, $languageId);

        if ($languageId != $defaultLanguageId) {
            $defaultPage = Page::getByIdAndLanguageId($pageId, $defaultLanguageId);
        } else {
            $defaultPage = $page;
        }

        if ($pageId == $reviewsPageId) {
            $reviews = Review::getAll();

            $reviewsDataProvider = new ArrayDataProvider([
                'allModels' => $reviews,
                'pagination' => [
                    'pageSize' => 3,
                    'defaultPageSize' => 3
                ],
            ]);

            $this->layout = 'main';
            return $this->render('reviews', [
                'page' => $page,
                'defaultPage' => $defaultPage,
                'reviewsDataProvider' => $reviewsDataProvider
            ]);
        }

        if ($pageId == $faqPageId) {
            $faq = Faq::getAll();

            $model = new ContactForm();

            if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
                return $this->asJson("Success!");
            }

            $this->layout = 'main';
            return $this->render('faq', [
                'page' => $page,
                'defaultPage' => $defaultPage,
                'faq' => $faq,
                'model' => $model,
            ]);
        }

        if ($pageId == $contactsPageId) {
            $this->layout = 'main';
            return $this->render('contact', [
                'page' => $page,
                'defaultPage' => $defaultPage,
            ]);
        }

        if ($pageId == $aboutPageId) {
            $reviews = Review::getAll(Review::STATUS_ACTIVE, 3);

            $this->layout = 'main';

            return $this->render('about', [
                'page' => $page,
                'defaultPage' => $defaultPage,
                'reviews' => $reviews,
            ]);
        }

        return $this->render('page', [
            'page' => $page,
            'defaultPage' => $defaultPage,
        ]);
    }
}
