<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'full_name')->textInput([
    		'maxlength' => true,    		
    ]) ?>
    
    <?= $form->field($model, 'country')->textInput([
    		'maxlength' => true,    		
    ]) ?>
    
    <?= $form->field($model, 'state')->textInput([
    		'maxlength' => true,    		
    ]) ?>
    
    <?= $form->field($model, 'city')->textInput([
    		'maxlength' => true,    		
    ]) ?>
    
    <?= $form->field($model, 'address')->textInput([
    		'maxlength' => true,    		
    ]) ?>
    
    
    <?= $form->field($model, 'zip')->textInput([
    		'type' => 'zip',
    ]) ?>
    
    <?= $form->field($model, 'phone')->textInput([
    		'type' => 'zip',
    ]) ?>


    <div class="form-group text-right">
        <?= Html::submitButton(!$model->id ? 'Create Profile' : 'Update Profile', ['class' => !$model->id ? 'btn btn-success' : 'btn btn-success']) ?>
        <?php if($model->id){
        	echo Html::a('Back to users', Url::toRoute(['users/index']), ['class' => 'btn btn-primary']);
        }?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
