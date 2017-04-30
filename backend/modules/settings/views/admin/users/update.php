<?php

use Yii;
use yii\helpers\Html;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model backend\models\Users */

$this->title = 'Update Profile: ' . $user->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $user->id, 'url' => ['view', 'id' => $user->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="col-lg-12">
	<div class="text-right">
		<p class="actions">
			<a class="btn btn-default btn-md" href="#user-main" aria-controls="user-main" role="tab" data-toggle="tab">User</a>
			<a class="btn btn-default btn-md" href="#user-profile" aria-controls="user-profile" role="tab" data-toggle="tab">Profile</a>
			<a class="btn btn-default btn-md" href="#user-company-profile" aria-controls="user-company-profile" role="tab" data-toggle="tab">Company Profile</a>
		</p>
	</div>
</div>
<div class="tab-content col-lg-12">
	<div class="tab-pane active" id="user-main">
		<?= $this->render('_form', [
	        'model' => $user,
	    ]) ?>
	</div>
	<div class="tab-pane" id="user-profile">
		<?= $this->render('_form-profile', [
	        'model' => $user->profile,
	    ]) ?>
	</div>
	<div class="tab-pane" id="user-company-profile">
		<?= $this->render('_form-company-profile', [
	        'model' => $user->companyProfile,
	    ]) ?>
	</div>
</div>