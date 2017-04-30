<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CompanyType */

$this->title = 'Create Company Type';
$this->params['breadcrumbs'][] = ['label' => 'Company Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-type-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
