<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\modules\settings\models\ProposalTypes;
use backend\modules\settings\models\CompanyCustomers;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\icons\Icon;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\modules\proposals\models\Proposals */
/* @var $form yii\widgets\ActiveForm */
$user = backend\modules\settings\models\Users::findOne(\Yii::$app->user->id);
$customers = CompanyCustomers::find()->where(['company_id' => $user->companyProfile->id]);
?>

<div class="proposals-form row">

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="col-lg-12">
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        
        <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-lg-6">
        <?= $form->field($model, 'proposal_type_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(ProposalTypes::find()->all(), 'id', 'title'),
            'options' => ['placeholder' => 'Select a state ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
            
        ]) ?>

        <?= $form->field($model, 'status_id')->dropDownList([
            $model::STATUS_DONE => 'COMPLITED',
            $model::STATUS_SCHEDULED => 'SCHEDULED',
            $model::STATUS_APROVED => 'APROVED',
            $model::STATUS_AWAITING_APROVAL => 'AWAITING APROVAL',
            $model::STATUS_ACTIVE => 'ACTIVE',
            $model::STATUS_NOT_APROVED => 'NOT APROVED',
            $model::STATUS_CLOSED => 'CLOSED',
        ], ['options' => [$model::STATUS_ACTIVE => ['selected' => 'selected']]]) ?>
    </div>
    <div class="col-lg-6">
        <?= $form->field($model, 'customer_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map($customers->all(), 'id', 'fullname'),
                'options' => ['placeholder' => 'Select a state ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
                'addon' => [                
                    'append' => [
                        'content' => Html::a(
                            Icon::show('plus'),
                            Url::toRoute(['/settings/company-customers/create']),
                            [
                                'class' => 'btn btn-primary', 
                                'title' => 'Add new', 
                                'data-toggle' => 'tooltip'
                            ]
                        ),
                        'asButton' => true
                    ]
                ]
            ])?>

        <?= $form->field($model, 'manager_id')->textInput() ?>

        <?= $form->field($model, 'est_price')->textInput() ?>
    </div>
    <div class="form-group col-lg-12 text-right">
        <?= Html::a('Back to list', yii\helpers\Url::toRoute(['index']), ['class' => 'btn btn-default']); ?>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        
    </div>

    <?php ActiveForm::end(); ?>

</div>
