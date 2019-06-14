<?php
/**
 * ReviewController controller class file.
 */

namespace app\module\admin\module\review\controllers;

use app\module\admin\models\Language;
use app\module\admin\module\review\models\ReviewDescription;
use Yii;
use app\module\admin\models\User;
use app\module\admin\module\review\models\Review;
use app\module\admin\module\review\models\ReviewSearch;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ReviewController implements the CRUD actions for Review model.
 */
class ReviewController extends Controller
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
     * Lists all Review models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReviewSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Review model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     *
     * @return mixed create view
     */
    public function actionCreate()
    {
        $review = new Review();

        $descriptions = [];

        $languages = Language::getAll(Language::STATUS_ACTIVE);

        foreach ($languages as $language) {
            $description = new ReviewDescription();

            if ($language['language_id'] == Language::getLanguageIdByCode(Yii::$app->language)) {
                $description->scenario = 'language-is-system';
            }

            $descriptions[$language['language_id']] = $description;
        }

        if ($review->load(Yii::$app->request->post()) && ReviewDescription::loadMultiple($descriptions, Yii::$app->request->post())) {
            // Save image
            $review->imageFile = UploadedFile::getInstance($review, 'imageFile');

            if ($review->imageFile !== null) {
                $review->image = $review->uploadImage('imageFile');
            }

            $isValid = $review->validate();

            $isValid = ReviewDescription::validateMultiple($descriptions, Yii::$app->request->post()) && $isValid;

            if ($isValid && $review->save(false)) {
                // Save descriptions
                foreach ($descriptions as $key => $description) {
                    $description->review_id = $review->review_id;
                    $description->language_id = $key;
                    $description->save(false);
                }

                return $this->redirect(['index']);
            }
        }

        if (empty($review->sort_order)) {
            $review->sort_order = 1;
        }

        return $this->render('create', [
            'review' => $review,
            'descriptions' => $descriptions,
            'languages' => $languages,
        ]);
    }

    /**
     * Updates an existing Review model.
     * If update is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id review ID
     * @return mixed update view
     * @throws NotFoundHttpException if model not found
     */
    public function actionUpdate($id)
    {
        $review = $this->findModel($id);

        $descriptions = [];

        $languages = Language::getAll(Language::STATUS_ACTIVE);

        foreach ($languages as $language) {
            $description = ReviewDescription::findOne([
                'review_id' => $review->review_id,
                'language_id' => $language['language_id']
            ]);

            $descriptions[$language['language_id']] = (!empty($description)) ? $description : new ReviewDescription();

            if ($language['language_id'] == Language::getLanguageIdByCode(Yii::$app->language)) {
                $descriptions[$language['language_id']]->scenario = 'language-is-system';
            }
        }

        if ($review->load(Yii::$app->request->post()) && ReviewDescription::loadMultiple($descriptions, Yii::$app->request->post())) {
            // Save image
            $review->imageFile = UploadedFile::getInstance($review, 'imageFile');

            if ($review->imageFile !== null) {
                $review->image = $review->uploadImage('imageFile');
            }

            $isValid = $review->validate();

            $isValid = ReviewDescription::validateMultiple($descriptions, Yii::$app->request->post()) && $isValid;

            if ($isValid && $review->save(false)) {
                // Update descriptions
                foreach ($descriptions as $key => $description) {
                    $description->review_id = $review->review_id;
                    $description->language_id = $key;
                    $description->save(false);
                }

                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'review' => $review,
            'descriptions' => $descriptions,
            'languages' => $languages,
        ]);
    }

    /**
     * Deletes an existing Review model.
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

        ReviewDescription::removeByReviewId($id);

        return $this->redirect(['index']);
    }

    /**
     * Finds the Review model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id model id
     * @return Review the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Review::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая страница не существует.');
        }
    }
}
