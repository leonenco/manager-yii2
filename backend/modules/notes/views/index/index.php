<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'My Notes';
$formatter = \Yii::$app->formatter;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">            
	<div class="col-md-12">
		<?php if($notes):?>
			<div class="actions text-right">
				<?= Html::a('Create new', ['new'], ['class' => 'btn btn-success'])?>
			</div>
		<?php endif;?>	
	</div>
</div>
<div class="row">            
	<div class="col-md-12">
		<?php if(!$notes):?>
			<div class="jumbotron text-center">
			<h1>Hi there, your notebook is empty right now!</h1>
			<p>Try to add one</p>
			<div class="actions">
				<?= Html::a('Create new', ['new'], ['class' => 'btn btn-lg btn-success'])?>
			</div>
			</div>
		<?php else: ?>
			<?php foreach($notes as $note):?>
				<div class="col-lg-3">
					<div class="note-folder">
						<a class="nlink" href="<?php echo Url::to(['view', 'id' => $note->id]);?>">
							<?php if($note->folder == true){					
								echo '<i class="fa fa-book" aria-hidden="true"></i>';
								} else {
								echo '<i class="fa fa-file-text-o" aria-hidden="true"></i>';
								}
							?>
							<h4><?php echo $note->title;?></h4>
							<p><?= $note->id;?></p>
							<p><?= $formatter->format($note->created_at, 'datetime');?></p>
						</a>
					</div>				
				</div>
			<?php endforeach;?>
		<?php endif;?>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<?php
			yii\bootstrap\Modal::begin([
			    'headerOptions' => ['id' => 'modalHeader'],
			    'id' => 'modal',
			    'size' => 'modal-lg',
			    //keeps from closing modal with esc key or by clicking out of the modal.
			    // user must click cancel or X to close
			    'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
			]);
			echo "<div id='modalContent'></div>";
			yii\bootstrap\Modal::end();
		?>
	</div>
</div>
