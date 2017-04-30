<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Users */

$this->title = 'Create Users';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

    <?= $this->render('_form', [
        'model' => $user,
    ]) ?>

</div>
