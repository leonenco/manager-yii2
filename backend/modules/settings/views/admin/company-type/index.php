<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Company Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
	<div class="col-lg-12 text-left">
		<div class="text-right">
			<p>
        		<?= Html::a('New', ['create'], ['class' => 'btn btn-success']) ?>
        	</p>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
	    <?= GridView::widget([
	        'dataProvider' => $dataProvider,
	    	'layout'=>"{items}\n{pager}{summary}",
	        'columns' => [
	            ['class' => 'yii\grid\SerialColumn'],
	
	            'id',
	            'title',
	            [
    				'attribute' => 'description',
    				'label' => 'Description',
    				'value' => function($data){
    					$desc = strpos($data->description, ' ', 120);
    					return substr($data->description, 0, $desc) . '...';	    			
	    			},
				],
	
	            ['class' => 'yii\grid\ActionColumn'],
	        ],
	    ]); ?>
	</div>
</div>
