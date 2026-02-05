<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\Seller;
use app\models\SellerSearch;

class SellerController extends Controller
{
    /**
     * Lists all Seller models.
     */
    public function actionIndex()
    {
        $searchModel = new SellerSearch();


        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Seller model.
     */
    public function actionCreate()
    {
        $model = new Seller();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Seller created successfully.');
            return $this->redirect(['index']);
        }

        return $this->render('form', [
            'model' => $model,
            'isEdit' => false,
        ]);
    }

    /**
     * Updates an existing Seller model.
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Seller updated successfully.');
            return $this->redirect(['index']);
        }

        return $this->render('form', [
            'model' => $model,
            'isEdit' => true,
        ]);
    }

    /**
     * Deletes an existing Seller model.
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Seller deleted successfully.');

        return $this->redirect(['index']);
    }

    /**
     * Finds the Seller model based on its primary key value.
     */
    protected function findModel($id)
    {
        if (($model = Seller::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
