<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\settings\models\CompanyCustomers */

$this->title = 'Update Company Customers: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Company Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="company-customers-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
