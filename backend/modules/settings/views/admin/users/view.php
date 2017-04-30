<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Users */
$profile = $user->profile;
$this->title = $profile->full_name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-12 users-view">
        <div class="row">
            <div class="col-lg-12 text-left">
                <div class="text-right">
                    <p class="actions">
                        <?= Html::a('Update', ['users/update', 'id' => $user->id], ['class' => 'btn btn-primary']) ?>				        
                        <?= Html::a('Back to users', Url::toRoute(['users/index']), ['class' => 'btn btn-primary']) ?>
                        <?php 
                        if($user->id !== 2){				        
                            echo Html::a('Delete', ['users/delete', 'id' => $user->id], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ]);
                        }?>
                    </p>
                </div>
            </div>
        </div>
        <?= DetailView::widget([
            'model' => $user,
            'attributes' => [
                'id',
                'username',
                [
                    'attribute' => 'role',
                    'label' => 'Role',
                    'value' => ucfirst($user->role),
                ],
                //'auth_key',
                //'password_hash',
                //'password_reset_token',
                'email:email',
                [
                    'attribute' => 'status',
                    'label' => 'Status',
                    'value' => ($user->status = 10)?'Active':'Suspended',
                ],
                //'created_at',
                //'updated_at',
            ],
        ]) ?>
        <hr>
        <?= DetailView::widget([
            'model' => $profile,
            'attributes' => [
                'full_name',
                'address',
                'country',
                'state',
                'city',
                'zip',
                'phone',
                'created_at:date',
            ],
        ]) ?>

    </div>
</div>
