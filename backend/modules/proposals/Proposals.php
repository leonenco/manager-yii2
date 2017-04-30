<?php

namespace backend\modules\proposals;

/**
 * proposals module definition class
 */
class Proposals extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\proposals\controllers';

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
