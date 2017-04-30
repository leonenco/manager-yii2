<?php 
namespace backend\modules\notes\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\modules\notes\models\Notes;
use yii\helpers\Url;

class IndexController extends Controller
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
        $model = Notes::find()
        ->andWhere(['created_by' => \Yii::$app->user->id])
        ->all();		
        $data = [
                        'notes' => $model,
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
            \Yii::$app->session->setFlash('success', "Note created");
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            \Yii::$app->session->setFlash('warning', "Error while creating");
        }
        return $this->refresh();
    } elseif (Yii::$app->request->isAjax) {
        return $this->renderAjax('create', [
                            'model' => $model
        ]);
    } else {
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    }

    public function actionView($id){
        $model = Notes::findOne($id);
        if($model){
            $data = [
                            'note' => $model,
            ];
            return $this->render('view', $data);
        } else {
            return self::actionNew();
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
            return $this->redirect('index');
        }
        return $this->refresh();
    }
}
?>