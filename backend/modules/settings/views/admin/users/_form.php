<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="col-lg-12">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'role')
	    ->dropDownList([
	        'user' => 'User',
	        'company' => 'Company',
	    	'admin' => 'Admin',
	    ],
	    [
	        'prompt' => 'Please select'
    	]);
    ?>    

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')
	    ->dropDownList([
	        '10' => 'Active',
	        '0' => 'Disabled',
	    ],
	    [
	        'prompt' => 'Please select'
    	]);
    ?>

    <div class="form-group text-right">
        <?= Html::submitButton(!$model->id ? 'Create' : 'Update', ['class' => !$model->id ? 'btn btn-success' : 'btn btn-success']) ?>
        <?php if($model->id){
        	echo Html::a('Back to users', Url::toRoute(['users/index']), ['class' => 'btn btn-primary']);
        }?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
