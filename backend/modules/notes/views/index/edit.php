<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model backend\models\Notes */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Edit note';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">            
	<div class="col-md-12">
		<div class="actions text-right">
			<?= Html::a('Edit', ['notes/edit', 'id' => $note->id], ['class' => 'btn btn-success'])?>
			<?= Html::a('Delete', ['notes/delete', 'id' => $note->id], ['class' => 'btn btn-danger'])?>
			<?= Html::a('Go back', Url::previous(), ['class' => 'btn btn-default'])?>
		</div>		
	</div>
</div>
<div class="row">
    <div class="col-lg-5">
        <p>Please fill out the following fields:</p>
        <?php $form = ActiveForm::begin(['id' => 'new-note-form']); ?>

			<?= $form->field($note, 'title')->textInput(['autofocus' => true]) ?>

			<?= $form->field($note, 'description')->textInput() ?>
			
			<?= $form->field($note, 'folder')->checkBox(['label' => 'Is this a Notebook?', 
'uncheck' => '0', 'checked' => '1']);?>

			<div class="form-group">
				<?= Html::submitButton('Update', ['class' => 'btn btn-primary', 'name' => 'create-button']) ?>
            </div>
		<?php ActiveForm::end(); ?>
    </div>
</div>
