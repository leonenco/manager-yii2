<?php

/* @var $this yii\web\View */
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->title = $note->title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">            
	<div class="col-md-12">
		<div class="actions text-right">
			<?= Html::a('Edit', ['index/edit', 'id' => $note->id], ['class' => 'btn btn-success'])?>
			<?= Html::a('Delete', ['index/delete', 'id' => $note->id], ['class' => 'btn btn-danger'])?>
			<?= Html::a('Go back', Url::previous(), ['class' => 'btn btn-default'])?>
		</div>		
	</div>
</div>
<div class="row">
	<div class="col-lg-6 note-view">
		<?= DetailView::widget([
	        'model' => $note,
	    	'attributes' => [
	    		'title',
	    		'description',
	    		[
	    				'attribute' => 'created_at',
	    				'label' => 'Created',
	    				'format' => 'date',
				],
	    		'updated_at:datetime',
	    	],
	    ]) ?>
	</div>	
</div>
