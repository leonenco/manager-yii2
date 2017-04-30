<?php

namespace backend\modules\settings\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use backend\modules\settings\models\Users;
use common\widgets\Alert;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
{
    protected $_user;
    protected $_profile;
    protected $_company;
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'delete' => ['POST'],
                ],
            ],
        ];
    }
    
    /*
     * Deny all users to access this controller
     * 
     */
    public function beforeAction($action){
    	if (\Yii::$app->user->identity->role != "admin") {
            //as a default behavior, it throws an exception
            throw new NotFoundHttpException("404 Not found.");
            //return true;
    	} else {
            Url::remember();
            return true;
    	}
    }

    /**
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
    	
        $dataProvider = new ActiveDataProvider([
            'query' => Users::find(),
        ]);
        return $this->render('/admin/users/index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('/admin/users/view', [
                            'user' => $this->findModel($id),
            ]);
        } else {
            return $this->render('/admin/users/view', [
                            'user' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->_user = new Users();

        if ($this->_user->load(Yii::$app->request->post()) && $this->_user->save()) {
        	Yii::$app->session->setFlash('success', "User created",false);
        } elseif (Yii::$app->request->isAjax) {
        	return $this->renderAjax('/admin/users/create', [
        			'user' => $this->_user,
        		]);
        } else {
			//throw new NotFoundHttpException("404 Not found.");
            return $this->render('/admin/users/create', [
                    'user' => $this->_user,
            ]);
        }
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
    	$this->findModel($id);
    	$this->findProfile($this->_user);
    	$this->findCompany($this->_user);

        if ($this->_user->load(Yii::$app->request->post()) && $this->_user->update()) {
        	Yii::$app->session->setFlash('success', "User updated",false);
            return $this->redirect(['/admin/users/view', 'id' => $this->_user->id]);
        } else if ($this->_profile->load(Yii::$app->request->post()) && $this->_profile->update()) {
        	Yii::$app->session->setFlash('success', "Profile updated",false);
            return $this->redirect(['/admin/users/view', 'id' => $this->_user->id]);
        } else if ($this->_company->load(Yii::$app->request->post()) && $this->_company->update()) {
        	Yii::$app->session->setFlash('success', "Company profile updated",false);
            return $this->redirect(['/admin/users/view', 'id' => $this->_user->id]);
        } else if (Yii::$app->request->isAjax) {
        	return $this->renderAjax('/admin/users/update', [
        			'user' => $this->_user,
        		]);
        } else {
        	return $this->render('/admin/users/update', [
        		'user' => $this->_user,
        	]);
        }
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
    	if($this->findModel($id)->delete()){
    		$auth = Yii::$app->authManager;
    		$auth->revokeAll($id);
    		Yii::$app->session->setFlash('success', "User deleted",false);
    	} else {
    		Yii::$app->session->setFlash('warning', "Server error",false);
    		return false;
    	}

        //return $this->redirect(['index']);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($this->_user = Users::findOne($id)) !== null) {
            return $this->_user;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /*
     * Return user profile
     */
    protected function findProfile($object){
    	if(($this->_profile = $object->profile) !== null){
    		return $this->_profile;
    	} else {
    		throw new NotFoundHttpException('Profile requested does not exist.');
    	}
    }
    /*
     * Return user company profile
     */
    protected function findCompany($object){
    	if(($this->_company = $object->companyProfile) !== null){
    		return $this->_company;
    	} else {
    		throw new NotFoundHttpException('Profile requested does not exist.');
    	}
    }
    
    /*
     * Set messages at the dash
     */
    public function afterAction($action, $result)
    {
    	if (Yii::$app->request->isAjax && !empty(Yii::$app->session->getAllFlashes())) {
    		echo Alert::widget();
    	}
    	return parent::afterAction($action, $result);
    }
}
