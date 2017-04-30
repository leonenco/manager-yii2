<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\DatePicker;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\proposals\models\SearchProposals */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Proposals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proposals-index">
    <?php //Pjax::begin(['id' => 'proposals', 'clientOptions' => ['method' => 'POST']]); ?>
    <p>
        <?= Html::a('Create Proposals', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
           'id' => 'proposals',
            'class' => 'table-responsive',  
        ],
        'tableOptions' => [
          'class' => 'table',  
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'title',
            'description:ntext',
            'createdBy.username',
            [
                'attribute' => 'created_at',
                'value' => 'created_at',
                'filter' => DatePicker::widget([
                    'options' => [
                        'id' => 'filter-created-at',
                    ],
                    'model' => $searchModel,
                    'attribute' => 'created_at',
                    'dateFormat' => 'yyyy-MM-dd',
                    'clientOptions' => [
                        'autoclose' => true,
                        'timepicker' => false,
                    ]
                ]),
               'format' => 'date',
            ],
            // 'updated_at',
            // 'address',
            // 'proposal_type_id',
            // 'status_id',
            // 'customer_id',
            // 'manager_id',
            [
                'attribute' => 'est_price',
                'value' => function($model){
                    return money_format('%i', $model->est_price);
                },
            ],
            // 'edited_by',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Action',
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
        'summary' => false,
    ]); ?>
    <?php //Pjax::end(); ?>
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
    $("#proposals").on("click","#delete", function(e){
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
    $(document).on("pjax:complete", function() {
        $("#ui-datepicker-div").datepicker();
    });

    ');
    ?>
