<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="login" class="site-login col-lg-12">
    <div class="row">
        <div class="col-lg-12 text-center">
            <a class="brand" href="<?= Yii::$app->params['baseUrl']?>">
                <img src="<?=Yii::$app->getHomeUrl()?>favicon.ico" alt="SManager panel" class="img-responsive logo login"/>
                <p>SManager</p>
            </a>
        </div>
        <div class="col-lg-12">
            <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

            <p>Please fill out the following fields to login:</p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin([
            		'id' => $model->formName(),
            ]); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>
                
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
                
                <div class="form-group">
                    <?= Html::a('Create new Account', Url::to(['site/signup']), ['class' => 'btn btn-success'])?>
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary pull-right', 'name' => 'login-button']) ?>
                </div>
                <div class="form-group text-center">
                    <?= Html::a('Forgot password', Url::to(['/login-reset']))?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>        
    </div>
</div>
