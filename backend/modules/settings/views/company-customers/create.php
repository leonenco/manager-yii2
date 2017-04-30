<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\settings\models\CompanyCustomers */

$this->title = 'Create Company Customers';
$this->params['breadcrumbs'][] = ['label' => 'Company Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-customers-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
