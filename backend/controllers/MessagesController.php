<?php 
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\Pagination;
use backend\models\Notes;
use yii\helpers\Url;

class MessagesController extends Controller {
	
	public $message = "Hello Message";
	
	public function behaviors()
	{
		return [
				'access' => [
						'class' => AccessControl::className(),
						'rules' => [
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
				],
				'verbs' => [
						'class' => VerbFilter::className(),
						'actions' => [
								'site/logout' => ['post'],
						],
				],
		];
	}
	
	public function actionIndex(){
		$data = [
				'message' => "Hello Message",
		];
		return $this->render('index', $data);
	}
	
}



?>