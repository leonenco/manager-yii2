<?php
namespace backend\widgets\notes;

use yii\web\AssetBundle;

class NotesLastAssets extends AssetBundle
{
	public $sourcePath = '@backend/widgets/notes/assets';
	public $css = [
			//'css/google.maps.css'
	];

	public $js = [
			//'https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places',
	];
	public $depends = [
			'yii\web\YiiAsset',
			'yii\bootstrap\BootstrapAsset',
	];
}