<?php

/* @var $this yii\web\View */

use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use Codeception\Util\Uri;
use yii\web\UrlManager;

$this->title = 'My Yii News';
?>
<div class="row">            
	<div class="col-md-12">
		<div class="actions">
			<div class="row">
				<div class="col-xs-12 col-lg-6">
			        <div class="btn-group">
				        <a class="btn btn-default" href="<?php echo Url::toRoute('new');?>"><span>New</span></a>
				        <a class="btn btn-default"><span>Edit</span></a>
				        <a class="btn btn-default"><span>Delete</span></a>
			        </div>
			    </div>
		        <div class="col-xs-12 col-lg-6 pull-right">
		            <input type="text" class="form-control" style="border-radius:0px" placeholder="Search">
		        </div>
			</div>		        
	    </div>
		<div class="content-table">
			<div class="row">
				<div class="col-lg-12">
					<div class="thead">
						<div class="col-lg-1 col-md-1 col-sm-1 hidden-xs">Id</div>
				        <div class="col-lg-3 col-md-3 col-sm-3 hidden-xs">Title</div>
				        <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs">Desc</div>
				        <div class="col-lg-2 col-md-2 col-sm-2 hidden-xs text-right">Actions</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="tbody row">
						<?php foreach($notes as $note):?>
							<div class="col-lg-1 col-md-1 col-sm-1 hidden-xs"><?= $note->id;?></div>
							<div class="col-lg-3 col-md-3 col-sm-3 hidden-xs"><?= $note->title;?></div>
							<div class="col-lg-6 col-md-6 col-sm-6 hidden-xs"><?php echo substr($note->description, 0, 15);?></div>
							<div class="col-lg-2 col-md-2 col-sm-2 hidden-xs text-right">
							    <a type="button" class="btn btn-xs btn-default" href="<?php echo Url::toRoute(['notes/edit','id'=> $note->id]);?>">
							    	<span class="glyphicon glyphicon-pencil"></span>
								</a>
								<a type="button" class="btn btn-xs btn-default" href="<?php echo Url::toRoute(['notes/delete','id'=> $note->id]);?>">
								    <span class="glyphicon glyphicon-trash"></span>
								</a>
								<a type="button" class="btn btn-xs btn-default" href="<?php echo Url::toRoute(['notes/view','id'=> $note->id]);?>">
									<span class="glyphicon glyphicon-eye-open"></span>
								</a>
							</div>  
						<?php endforeach;?>
					</div>
				</div>

			</div>				
		</div>
		
		<div class="content-footer">
			<div class="row">
				<div class="col-xs-12 col-lg-4">
					<div class="dataTables_info" id="example_info">Showing 51 - 60 of 100 total results</div>
				</div>
				<div class="col-xs-12 col-lg-4 text-center">
					<div class="dataTables_paginate paging_bootstrap">
						<?php 
						echo LinkPager::widget([
							'pagination' => $pages,
							'firstPageLabel' => '<<',
							'lastPageLabel' => '>>',
							'prevPageLabel' => '<',
							'nextPageLabel' => '>',
							'maxButtonCount' => 3,
							'options' => [
									'class' => 'pagination pagination-sm',
							]
						]);
						?>
					</div>	
				</div>
				<div class="col-xs-12 col-lg-4 text-right">
					<div class="btn-group">
						<form action="<?php echo Url::previous();?>" method="get" class="form-inline">
							<select name="per-page" class="form-control">
								<option <?php if($active == 5) echo 'selected'; ?> >5</option>
								<option <?php if($active == 10) echo 'selected'; ?> >10</option>
								<option <?php if($active == 15) echo 'selected'; ?> >15</option>
							</select>
							<span>items per page </span>
							<form-group>
								<button type="submit">Refresh</button>
							</form-group>
						</form>						
					</div>
				</div>						
			</div>				
		</div>
	</div>
</div>
