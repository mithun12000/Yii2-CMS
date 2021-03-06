<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../../../framework/Yii.php');
require(__DIR__ . '/../../common/config/aliases.php');

$config = yii\helpers\ArrayHelper::merge(
    require(Yii::getAlias('@common').'/config/main.php'),
    require(Yii::getAlias('@common').'/config/main-local.php'),
    require(Yii::getAlias('@frontend').'/config/main.php'),
    require(Yii::getAlias('@frontend').'/config/main-local.php')
);

//print_r($config);
//*/
$application = new yii\web\Application($config);
$application->run();
//*/
