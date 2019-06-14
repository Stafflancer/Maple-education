<?php
/**
 * BannerController class file.
 */

namespace app\module\admin\controllers;

use Yii;
use app\module\admin\models\User;
use app\components\ImageBehavior;
use app\module\admin\models\BannerImage;
use app\module\admin\models\Banner;
use app\module\admin\models\BannerSearch;
use app\module\admin\models\Language;
use yii\data\ArrayDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;

/**
 * BannerController implements the CRUD actions for Banner model.
 *
 * @package app\module\admin\controllers
 */
class BannerController extends Controller
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
     * Lists all Banner models.
     *
     * @return mixed index view
     */
    public function actionIndex()
    {
        $searchModel = new BannerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Banner model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     *
     * @return mixed create view or response object
     */
    public function actionCreate()
    {
        /** @var Banner|ImageBehavior $model */
        $model = new Banner();

        $languages = Language::getAll(Language::STATUS_ACTIVE);

        $dataProviders = [];
        $errors = [];

        foreach ($languages as $language) {
            $bannerImages = [];

            if (isset(Yii::$app->request->post('BannerImage')[$language['language_id']])) {
                $postData = [];
                $bannerImagesPost = Yii::$app->request->post('BannerImage')[$language['language_id']];

                $count = count($bannerImagesPost);

                for ($i = 0; $i < $count; $i++) {
                    $bannerImages[] = new BannerImage();
                }

                foreach ($bannerImagesPost as $rawPostDataItem) {
                    $postData['BannerImage'][] = $rawPostDataItem;
                }

                BannerImage::loadMultiple($bannerImages, $postData);
            }

            $dataProvider = new ArrayDataProvider([
                'key' => 'banner_image_id',
                'modelClass' => 'app\module\admin\models\BannerImage',
                'allModels' => $bannerImages,
            ]);

            $dataProviders[$language['language_id']] = $dataProvider;
        }

        if ($model->load(Yii::$app->request->post())) {

            $isValid = $model->validate();

            foreach ($languages as $language) {
                $bannerImagesModels = $dataProviders[$language['language_id']]->getModels();

                $isValid = BannerImage::validateMultiple($bannerImagesModels) && $isValid;

                if (!$isValid) {
                    /** @var BannerImage|ImageBehavior $bannerImagesModel */
                    foreach ($bannerImagesModels as $bannerImagesModel) {
                        $errors[$language['language_id']]['BannerImage'][] = $bannerImagesModel->getErrors();
                    }
                }
            }

            if ($isValid && $model->save(false)) {
                foreach ($languages as $language) {
                    $bannerImagesModels = $dataProviders[$language['language_id']]->getModels();

                    foreach ($bannerImagesModels as $key => $bannerImagesModel) {
                        $bannerImagesModel->banner_id = $model->banner_id;
                        $bannerImagesModel->language_id = $language['language_id'];

                        $bannerImagesModel->imageFile = UploadedFile::getInstance($bannerImagesModel, "[{$language['language_id']}][{$key}]imageFile");

                        if ($bannerImagesModel->validate()) {
                            if (!empty($bannerImagesModel->imageFile)) {
                                $bannerImagesModel->image = $bannerImagesModel->uploadImage();
                            }

                            $bannerImagesModel->save(false);
                        }
                    }
                }

                return $this->redirect(['index']);
            }
        }

        $placeholder = ImageBehavior::placeholder(100, 100);

        return $this->render('create', [
            'model' => $model,
            'languages' => $languages,
            'dataProviders' => $dataProviders,
            'placeholder' => $placeholder,
            'errors' => $errors
        ]);
    }

    /**
     * Updates an existing Banner model.
     * If update is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id Banner id
     * @return mixed update view or response object
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Exception|\Throwable in case delete failed
     * @throws \yii\db\StaleObjectException if [[optimisticLock|optimistic locking]] is enabled and the data
     */
    public function actionUpdate($id)
    {
        /** @var $model Banner|ImageBehavior */
        $model = $this->findModel($id);

        $languages = Language::getAll(Language::STATUS_ACTIVE);

        $dataProviders = [];
        $errors = [];

        foreach ($languages as $language) {
            $bannerImages = [];

            if (isset(Yii::$app->request->post('BannerImage')[$language['language_id']])) {
                $postData = [];
                $bannerImagesPost = Yii::$app->request->post('BannerImage')[$language['language_id']];

                $count = count($bannerImagesPost);

                for ($i = 0; $i < $count; $i++) {
                    $bannerImages[] = new BannerImage();
                }

                foreach ($bannerImagesPost as $rawPostDataItem) {
                    $postData['BannerImage'][] = $rawPostDataItem;
                }

                BannerImage::loadMultiple($bannerImages, $postData);
            } else {
                $bannerImages = BannerImage::getAllByBannerIdAndLanguageId($model->banner_id, $language['language_id']);
            }

            $dataProvider = new ArrayDataProvider([
                'key' => 'banner_image_id',
                'modelClass' => 'app\module\admin\models\BannerImage',
                'allModels' => $bannerImages,
            ]);

            $dataProviders[$language['language_id']] = $dataProvider;
        }

        if ($model->load(Yii::$app->request->post())) {

            $isValid = $model->validate();

            foreach ($languages as $language) {
                $bannerImagesModels = $dataProviders[$language['language_id']]->getModels();

                $isValid = BannerImage::validateMultiple($bannerImagesModels) && $isValid;

                if (!$isValid) {
                    /** @var BannerImage|ImageBehavior $bannerImagesModel */
                    foreach ($bannerImagesModels as $bannerImagesModel) {
                        $errors[$language['language_id']]['BannerImage'][] = $bannerImagesModel->getErrors();
                    }
                }
            }

            if ($isValid && $model->save(false)) {
                BannerImage::removeByBannerId($id);

                foreach ($languages as $language) {
                    $bannerImagesModels = $dataProviders[$language['language_id']]->getModels();

                    foreach ($bannerImagesModels as $key => $bannerImagesModel) {
                        $bannerImagesModel->banner_id = $model->banner_id;
                        $bannerImagesModel->language_id = $language['language_id'];

                        $bannerImagesModel->imageFile = UploadedFile::getInstance($bannerImagesModel, "[{$language['language_id']}][{$key}]imageFile");

                        if ($bannerImagesModel->validate()) {
                            if (!empty($bannerImagesModel->imageFile)) {
                                $bannerImagesModel->image = $bannerImagesModel->uploadImage();
                            }

                            $bannerImagesModel->save(false);
                        }
                    }
                }

                return $this->redirect(['index']);
            }
        }

        $placeholder = ImageBehavior::placeholder(100, 100);

        return $this->render('update', [
            'model' => $model,
            'languages' => $languages,
            'dataProviders' => $dataProviders,
            'placeholder' => $placeholder,
            'errors' => $errors
        ]);
    }

    /**
     * Deletes an existing Banner model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id Banner id
     * @return mixed response object
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Exception|\Throwable in case delete failed
     * @throws \yii\db\StaleObjectException if [[optimisticLock|optimistic locking]] is enabled and the data
     * being deleted is outdated
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        BannerImage::removeByBannerId($id, true);

        return $this->redirect(['index']);
    }

    /**
     * Finds the Banner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id Banner id
     * @return Banner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Banner::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая страница не существует.');
        }
    }
}
