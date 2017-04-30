<?php 
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\Pagination;
use backend\models\Notes;
use yii\helpers\Url;

class NotesController extends Controller
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
	
	/**
	 * Displays homepage.
	 *
	 * @return string
	 */
	public function actionIndex(){
		Url::remember();
		$active = '';
		if(Yii::$app->request->get('per-page')){
			$query = Notes::find();
			$count = $query->count();
			$pagination = new Pagination(['totalCount' => $count, 'pageSize' => Yii::$app->request->get('per-page')]);
			$model = $query->offset($pagination->offset)
			->orderBy(['id'=>SORT_DESC])
			->limit($pagination->limit)
			->all();
			$active = Yii::$app->request->get('per-page');
		} else {
			$query = Notes::find();
			$count = $query->count();
			$pagination = new Pagination(['totalCount' => $count, 'pageSize' => 5]);
			$model = $query->offset($pagination->offset)
			->orderBy(['id'=>SORT_DESC])
			->limit($pagination->limit)
			->all();
			$active = 5;
		}
		
		$data = [
				'notes' => $model,
				'pages' => $pagination,
				'active' => $active
		];
		return $this->render('index', $data);
	}
	/*
	 * Create new Note
	 * */
	public function actionNew(){
		$model = new Notes();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', "Note created");
            } else {
                Yii::$app->session->setFlash('error', "Error while creating");
            }
            return $this->refresh();
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
	}
	
	public function actionView($id){
		$note = Notes::getOne($id);
		if($note){
			$data = [
					'note' => $note
			];
			return $this->render('view', $data);
		} else {
			return self::actionNew();
		}
	}
	
	public function actionEdit($id){
		$model = Notes::getOne($id);
		if ($model->load(Yii::$app->request->post())) {
			if ($model->save()){
				Yii::$app->session->setFlash('success', "Note updated");
			} else {
				Yii::$app->session->setFlash('error', "Error while updating");
			}
			return $this->refresh();
		} else {
			return $this->render('edit', [
					'model' => $model,
			]);
		}
	}
	
	public function actionDelete($id){
		$model = Notes::getOne($id);
		if ($model->delete()) {
			return $this->goBack(Url::previous());
		}
		return $this->refresh();
	}
}
?>