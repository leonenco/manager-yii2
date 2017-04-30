<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\proposals\models\Proposals */

$this->title = 'Create Proposals';
$this->params['breadcrumbs'][] = ['label' => 'Proposals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proposals-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
