<?php
$params = array_merge(
    require(Yii::getAlias('@common').'/config/params.php'),
    require(__DIR__.'/params.php')
);

return [
    'id' => 'app-backend',
    'name' => 'Backbone',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'modules' => [      
        'user' => [
            'class' => 'backend\modules\user\Module',
        ],
        'group' => [
            'class' => 'backend\modules\group\Module',
        ],
         'cuisine' => [
            'class' => 'backend\modules\cuisine\Module',

        ],
        'feature' => [
            'class' => 'backend\modules\feature\Module',
        ],      
        'restaurant' => [
            'class' => 'backend\modules\restaurant\Module',
        ], 
        'entity' => [

            'class' => 'backend\modules\entity\Module',

        ],
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
