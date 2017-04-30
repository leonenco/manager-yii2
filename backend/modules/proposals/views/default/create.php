<?php

use yii\helpers\Html;



/* @var $this yii\web\View */
/* @var $model backend\modules\proposals\models\Proposals */

$this->title = 'Create Proposals';
$this->params['breadcrumbs'][] = ['label' => 'Proposals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proposals-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
