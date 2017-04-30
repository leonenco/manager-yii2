<?php

namespace backend\modules\notes;

use Yii;

/**
 * notes module definition class
 */
class ModuleNotes extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\notes\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        
		if(\Yii::$app->user->identity->role == 'admin'){
			$this->defaultRoute = 'admin';
		}
        // custom initialization code goes here
    }
}
