<?php

use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Users;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-lg-12">
        <?php Pjax::begin(['id' => 'users', 'clientOptions' => ['method' => 'POST']]); ?>
                <div class="row">
                    <div class="col-lg-12 text-left">
                        <div class="text-right">
                            <p class="actions">							
                                <?= Html::button('Create user', ['value' => Url::to(['users/create']), 'title' => 'Create new user', 'class' => 'btn btn-success', 'id' => 'dialog']); ?>
                            </p>
                            <p><?= \Yii::$app->user->identity->role ?></p>
                        </div>
                    </div>
                </div>
                <?= GridView::widget([
                'dataProvider' => $dataProvider,			
                'layout'=>"{items}\n{pager}{summary}",
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],	
                    'id',
                    'username',
                    'role',
                    //'auth_key',
                    //'password_hash',
                    //'password_reset_token',
                     'email:email',
                     [
                            'attribute'=>'status',
                            'label'=>'Status',
                            'value'=>function($data){
                                return ($data->status == 10) ?  'Active': 'Disabled';
                            },
                        ],
                    'created_at',
                    'updated_at',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'contentOptions' => ['class' => 'text-center'],
                        'buttons' => [
                                'view' => function ($url, $model) {
                                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 
                                                $url, [
                                                        'id'=>'view',            							
                                                ]);
                                },
                                'update' => function ($url, $model) {
                                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                                                $url, [
                                                                'id'=>'update',
                                                ]);
                                },
                                'delete' => function ($url, $model) {
                                        return Html::a('<span class="glyphicon glyphicon-trash"></span>',
                                                $url, [
                                                                //'title' =>'Delete',
                                                                'id'=>'delete',
                                                                //'data-pjax'=>'1',
                                                ]);
                                },
                        ],		            		
                    ],
                ],
            ]); ?>
        <?php Pjax::end(); ?>
    </div>
    <?php 
    $this->registerJs('
    $(document).on("click","#dialog", function(e){
        e.preventDefault();
        $("#modal").modal("show")				
                .find("#modalContent")
                .load($(this).attr("value"));
        return false;
    });
    $("#modal").on("submit", "form", function(e){
        e.preventDefault();
        var form = $(this);
        var action = form.attr("action");
        $.post(action, form.serialize())
        .done(function (data) {
            form.trigger("reset");
            $("#modal").modal("hide");
            $("#system-messages").html(data).stop().fadeIn().animate({opacity: 1.0}, 4000).fadeOut("slow");
            $.pjax.reload({container: "#users"});
        });
        return false;
    });
    $("#users").on("click","#delete", function(e){
        e.preventDefault();
        if(confirm("Are you sure you want to delete this?")){
            var url = $(this).attr("href");
            $.post(url).done(function (data) {
                    $("#system-messages").html(data).stop().fadeIn().animate({opacity: 1.0}, 4000).fadeOut("slow");
                    $.pjax.reload({container: "#users"});
            });            
        }
        return false;
    });		

    ');
    ?>
</div>
<?php
    Modal::begin([
        'headerOptions' => ['id' => 'modalHeader'],
        'header' => 'Create user',
        'id' => 'modal',
        'size' => 'modal-lg',
        //keeps from closing modal with esc key or by clicking out of the modal.
        // user must click cancel or X to close
        'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
    ]);
    echo "<div id='modalContent'></div>";
    Modal::end();
?>
