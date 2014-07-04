<?php
$params = array_merge(
    require(Yii::getAlias('@common').'/config/params.php'),
    require(__DIR__.'/params.php')
);

return [
    'id' => 'app-backend',
    'name' => 'Backbone',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'modules' => [
		/*/
        'usermanage' => [
            'class' => 'backend\modules\usermanage\Module',
        ],
        'city' => [
            'class' => 'backend\modules\city\Module',
        ],
        'state' => [
            'class' => 'backend\modules\state\Module',
        ],
         'country' => [
            'class' => 'backend\modules\country\Module',
        ],
		//*/
    ],
    'components' => [
        'assetManager' => [
            'bundles' => [
                /*'yii\web\JqueryAsset' => [
                     'sourcePath' => null,
                     'js' => []
                ],//*/
                'yii\bootstrap\BootstrapAsset' => [
                     'sourcePath' => null,
                     'css' => []
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                     'sourcePath' => null,
                     'js' => []
                ],
                'yii\grid\GridViewAsset' => [
                    'depends'   => [
                        'backend\assets\AppAsset'
                    ],
                ],
            ],            
            'linkAssets' => true,
        ],        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=tc_backend',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8'
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
