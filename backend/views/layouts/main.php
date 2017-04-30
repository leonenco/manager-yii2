<?php

use Yii;
	if(Yii::$app->user->isGuest){
		$this->beginContent('@backend/views/layouts/login.php');
		echo $content;
		$this->endContent();
	} else {
		$this->beginContent('@backend/views/layouts/backend.php');
		echo $content;
		$this->endContent();
	}
?>