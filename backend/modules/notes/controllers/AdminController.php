<?php 
namespace backend\modules\notes\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use backend\modules\notes\models\Notes;
use common\widgets\Alert;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

class AdminController extends Controller
{
	public $id;
	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
            return [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                        [
                            'actions' => ['site/login', 'error'],
                            'allow' => true,
                        ],
                        [
                            'actions' => ['site/logout', 'index'],
                            'allow' => true,
                            'roles' => ['@'],
                        ]
                    ],
                    'denyCallback' => function ($rule, $action) {
                        throw new \Exception('You are not allowed to access this page');
                    },
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                                    'site/logout' => ['post'],
                    ],
                ],
            ];
	}
	/**
	 * @inheritdoc
	 */
	public function actions(){
            return [
                'error' => [
                    'class' => 'yii\web\ErrorAction',
                ],
            ];
	}
	/*
	 * Handle request and remember url
	 */
	public function beforeAction($action){
		
            return parent::beforeAction($action);
	}
	/**
	 * Displays homepage.
	 *
	 * @return string
	 */
	public function actionIndex(){
            Url::remember();
            $model = new ActiveDataProvider([
                            'query' => Notes::find(),
                            'pagination' => [
                                            'pageSize' => 20,
                            ],
            ]);	
            $data = [
                            'notes' => $model,
            ];
            return $this->render('index', $data);
	}
	
	public function actionView($id){
            $model = Notes::findOne($id);
            if($model){
                $data = [
                                'note' => $model,
                ];
                if (Yii::$app->request->isAjax) {
                        return $this->renderAjax('view', $data);
                } else {
                        return $this->render('view', $data);
                }
            } else {
                throw new NotFoundHttpException("404 Not found.");
            }
	}
	
	public function actionEdit($id){
            $model = Notes::findOne($id);
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                if ($model->update()){
                        Yii::$app->session->setFlash('success', "Updated");
                        return $this->redirect(['view', 'id' => $model->id]);
                } else {
                        Yii::$app->session->setFlash('error', "Some error ocure while updating");
                }
                return $this->refresh();
            } else {
                return $this->render('edit', [
                                'note' => $model,
                ]);
            }
	}
	
	public function actionDelete($id){
            $model = Notes::findOne($id);
            if ($model->delete()) {
                Yii::$app->session->setFlash('success', "Note deleted");
            } else {
                throw new NotFoundHttpException("404 Not found.");
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
?>