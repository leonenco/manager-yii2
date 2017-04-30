<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use backend\models\Users;
use yii\widgets\Pjax;
use yii\grid\GridView;

$this->title = 'My Notes';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php 
	$user = \Yii::$app->user->id;
	$user = Users::findOne($user);
	var_dump($user->profile->full_name);
?>
<div class="row">            
	<div class="col-md-12">
		<?php Pjax::begin(['id' => 'notes', 'clientOptions' => ['method' => 'POST']]); ?>
			<?= GridView::widget([
		        'dataProvider' => $notes,			
		    	'layout'=>"{items}\n{pager}{summary}",
		        'columns' => [
		            ['class' => 'yii\grid\SerialColumn'],	
		            'id',
		            'title',
		            'description',
		            [
			            'attribute'=>'folder',
			            'label'=>'Status',
			            'value'=>function($data){
			            	return ($data->folder == 1) ?  'Folder': 'File';
			            },
			        ],
			        [
			            'attribute'=>'created_by',
			            'label'=>'Owner',
			            'value' => function($data) {
				            return $data->user->username;
			            }
			        ],
		            [
			            'attribute'=>'created_at',
			            'label'=>'Created',
			            'value'=>function($data){
			            	return \Yii::$app->formatter->format($data->created_at, 'datetime');
			            },
			        ],
		            [
			            'attribute'=>'updated_at',
			            'label'=>'Updated',
			            'value'=>function($data){
			            	return \Yii::$app->formatter->format($data->updated_at, 'datetime');
			            },
			        ],
		
		            [
	            		'class' => 'yii\grid\ActionColumn',
		            	'contentOptions' => ['class' => 'text-center'],
		            	'template' => '{view}{delete}',
	            		'buttons' => [
            				'view' => function ($url, $model) {
	            				return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 
            						$url, [
	            						'id'=>'view',            							
	            					]);
	            			},
	            			'delete' => function ($url, $model) {
		            			return Html::a('<span class="glyphicon glyphicon-trash"></span>',
	            					$url, [
	            							//'title' =>'Delete',
	            							'id'=>'delete',
	            							//'data-pjax'=>'1',
	            					]);
	            			},
            			],		            		
			        ],
		        ],
		    ]); ?>
		<?php Pjax::end(); ?>
	</div>
</div>