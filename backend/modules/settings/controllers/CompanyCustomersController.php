<?php

namespace backend\modules\settings\controllers;

use Yii;
use backend\modules\settings\models\CompanyCustomers;
use backend\modules\settings\models\CompanyCustomersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CompanyCustomersController implements the CRUD actions for CompanyCustomers model.
 */
class CompanyCustomersController extends Controller
{
    protected $_company_id;
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    
    /*
     * Check access for company only and admin
     * @return bool
     */
    public function beforeAction($action) {
        if(Yii::$app->user->identity->role === 'user') {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $this->findCompany(\Yii::$app->user->id);
        return parent::beforeAction($action);
    }

    /**
     * Lists all CompanyCustomers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompanyCustomersSearch();
        $searchModel = $searchModel->find()->where(['company_id' => $this->_company_id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CompanyCustomers model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CompanyCustomers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CompanyCustomers();
        $model->company_id = $this->_company_id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CompanyCustomers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CompanyCustomers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CompanyCustomers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CompanyCustomers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CompanyCustomers::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
     * Finds the CompanyProfile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CompanyProfile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findCompany($id)
    {
        if (($user = \backend\modules\settings\models\Users::findOne($id)) !== null) {
            $company = $user->companyProfile;
            $this->_company_id = $company->id;
            return $this->_company_id;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
