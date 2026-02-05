<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
use app\models\Product;
use app\models\ProductSearch;
use app\models\Seller;

class ProductController extends Controller
{
    /**
     * Lists all Product models.
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $sellers = ArrayHelper::map(Seller::find()->all(), 'id', 'name');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'sellers' => $sellers,
        ]);
    }

    /**
     * Creates a new Product model.
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Product created successfully.');
            return $this->redirect(['index']);
        }

        $sellers = ArrayHelper::map(Seller::find()->all(), 'id', 'name');

        return $this->render('form', [
            'model' => $model,
            'isEdit' => false,
            'sellers' => $sellers,
        ]);
    }

    /**
     * Updates an existing Product model.
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Product updated successfully.');
            return $this->redirect(['index']);
        }

        $sellers = ArrayHelper::map(Seller::find()->all(), 'id', 'name');

        return $this->render('form', [
            'model' => $model,
            'isEdit' => true,
            'sellers' => $sellers,
        ]);
    }

    /**
     * Deletes an existing Product model.
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Product deleted successfully.');

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
