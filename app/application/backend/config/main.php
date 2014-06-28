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
        'usermanage' => [
            'class' => 'backend\modules\usermanage\Module',
        ],
         'cuisine' => [
            'class' => 'backend\modules\cuisine\Module',

        ],
        'hotel' => [

            'class' => 'backend\modules\hotel\Module',
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
        'city' => [

            'class' => 'backend\modules\city\Module',

        ],
        'locality' => [

            'class' => 'backend\modules\locality\Module',

        ],
        'zone' => [

            'class' => 'backend\modules\zone\Module',

        ],
        'service' => [

            'class' => 'backend\modules\service\Module',
        ],
        'payment' => [

            'class' => 'backend\modules\payment\Module',
        ],
        'state' => [

            'class' => 'backend\modules\state\Module',
        ],
         'country' => [

            'class' => 'backend\modules\country\Module',
        ],
        
         'category' => [

            'class' => 'backend\modules\category\Module',
        ],
         'crowd' => [

            'class' => 'backend\modules\crowd\Module',
        ],
         'usp' => [

            'class' => 'backend\modules\usp\Module',
        ],
        'source' => [

            'class' => 'backend\modules\source\Module',
        ],
        'dishes' => [

            'class' => 'backend\modules\dishes\Module',

        ],
        'music' => [

            'class' => 'backend\modules\music\Module',

        ],
        'criticreviews' => [

            'class' => 'backend\modules\criticreviews\Module',

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
