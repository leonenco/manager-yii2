<?php
namespace backend\widgets\notes;

use backend\widgets\notes\NotesListAssets;
use yii\helpers\Html;
use yii\web\View;
use Yii;
/**
 * Description of Language
 *
 * @author aleksey
 */
class NotesLast extends \yii\bootstrap\Widget {
	public $model;
	
	public function init() {
		parent::init();
		$view = Yii::$app->getView();
		$this->registerAssets();
		$view->registerJs($this->getJs());
	}
	
	public function run() {
		return $this->render('notesList');
	}

	/**
	 * Registers the needed assets
	 */
	public function registerAssets()
	{
		$view = $this->getView();
		NotesLastAssets::register($view);
	}

	private function getJs() {
		
		//Ваш js код должен быть здесь.
		//Это ваше домашнее задание.))
	}
}