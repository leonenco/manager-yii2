<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\settings\models\CompanyCustomersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Company Customers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-customers-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="col-lg-12 text-left">
        <div class="text-right">
            <p class="actions">
                <?= Html::a('Create Company Customers', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'company_id',
            'fullname',
            'phone',
            'email:email',
            // 'address',
            // 'photo',
            // 'status',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
