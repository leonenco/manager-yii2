<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Users;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
	<div class="col-lg-12 text-left">
		<div class="">
			<p>
				<?= Html::a('Create Users', ['create'], ['class' => 'btn btn-success']) ?>
				</p>
			</div>
		</div>
	</div>
    <div class="row">
	    <?php $users = $dataProvider->getModels();
    	foreach ($users as $user){	    		
    		$profile = Users::getOneProfile($user->id);?>
    		<div class="col-md-4">
	            <div class="well well-sm">
	                <div class="media">
	                    <a class="pull-left" href="#">
	                        <span class="glyphicon glyphicon-user"></span>
	                    </a>
	                    <div class="media-body">
	                        <h4 class="media-heading"><?php echo $profile->first_name . " " . $profile->last_name; ?></h4>
	                        <h6><p><strong id="user-name">Username: <?php echo $user->username;?></strong></p></h6>
			                <h6><p id="user-frid">FBT000000213</p></h6>
			                <h6><p id="user-mail"><?= $user->email; ?></p></h6>
			                <h6><p id="user-role">Role: <?= $user->role;?></p></h6>
			                <h6><p><strong>A/C status : </strong><span class="label label-success" id="user-status">Active</span></p></h6>
	                    </div>
	                    <div class="media-foter">
	                    	<p class="text-right margin10-top">
	                            <a href="<?php echo Url::toRoute(['users/view', 'id' => $user->id]);?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-eye-open"></span> View</a>
	                            <a href="<?php echo Url::toRoute(['users/update', 'id' => $user->id]);?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
	                            <a href="<?php echo Url::toRoute(['users/delete', 'id' => $user->id]);?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove"></span> Delete</a>
	                        </p>
	                    </div>
	                </div>
	            </div>
	        </div>	    	
    <?php } ?>
</div>