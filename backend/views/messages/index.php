<?php

/* @var $this yii\web\View */

use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use Codeception\Util\Uri;
use yii\web\UrlManager;

$this->title = 'Messages';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">            
            <div class="col-md-12">
		        <div class="panel panel-default">
					<div style="margin:7px">
				        <div class="col-xs-6">
					        <div class="btn-group">
						        <a class="btn btn-default" href="<?php echo Url::toRoute('messages/new');?>"><span>New</span></a>
						        <a class="btn btn-default"><span>Edit</span></a>
						        <a class="btn btn-default"><span>Delete</span></a>
					        </div>
					    </div>
				        <div class="col-xs-6 pull-right form-group">
				            <input type="text" class="form-control" style="border-radius:0px" placeholder="Search">
				        </div>
				    </div>
					<div class="panel-body">
						<h1><?php echo $message;?></h1>
					</div>
					<div class="panel-footer">
						<div class="col-xs-3">
							<div class="dataTables_info" id="example_info">Showing 51 - 60 of 100 total results</div>
						</div>
						<div class="col-xs-6">
							
						</div>
						<div class="btn-group">					
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
