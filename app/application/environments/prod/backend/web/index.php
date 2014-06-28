<?php
defined('YII_DEBUG') or define('YII_DEBUG', false);
defined('YII_ENV') or define('YII_ENV', 'prod');

require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../../../framework/Yii.php');
require(__DIR__ . '/../../common/config/aliases.php');

$config = yii\helpers\ArrayHelper::merge(
    require(Yii::getAlias('@common').'/config/main.php'),
    require(Yii::getAlias('@common').'/config/main-local.php'),
    require(Yii::getAlias('@backend').'/config/main.php'),
    require(Yii::getAlias('@backend').'/config/main-local.php')
);
/*
echo '<pre>';
print_r($config);
echo '</pre>';
///*/
$application = new yii\web\Application($config);
$application->run();
