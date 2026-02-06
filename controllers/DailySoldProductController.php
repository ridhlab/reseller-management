<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\DailySoldProduct;
use app\models\DailySoldProductSearch;
use app\models\Product;
use app\models\Seller;

class DailySoldProductController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all DailySoldProduct models.
     */
    public function actionIndex()
    {
        $searchModel = new DailySoldProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $sellers = ArrayHelper::map(Seller::find()->all(), 'id', 'name');
        $products = ArrayHelper::map(Product::find()->all(), 'id', 'name');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'sellers' => $sellers,
            'products' => $products,
        ]);
    }

    /**
     * Creates a new DailySoldProduct model.
     */
    public function actionCreate()
    {
        $model = new DailySoldProduct();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Daily sold product created successfully.');
            return $this->redirect(['index']);
        }

        $products = ArrayHelper::map(Product::find()->all(), 'id', 'name');

        return $this->render('form', [
            'model' => $model,
            'isEdit' => false,
            'products' => $products,
        ]);
    }

    /**
     * Updates an existing DailySoldProduct model.
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Daily sold product updated successfully.');
            return $this->redirect(['index']);
        }

        $products = ArrayHelper::map(Product::find()->all(), 'id', 'name');

        return $this->render('form', [
            'model' => $model,
            'isEdit' => true,
            'products' => $products,
        ]);
    }

    /**
     * Deletes an existing DailySoldProduct model.
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Daily sold product deleted successfully.');

        return $this->redirect(['index']);
    }

    /**
     * Finds the DailySoldProduct model based on its primary key value.
     */
    protected function findModel($id)
    {
        if (($model = DailySoldProduct::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
