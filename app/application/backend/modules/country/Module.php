<?php

namespace backend\modules\country;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\country\controllers';
    public $defaultRoute='country';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
