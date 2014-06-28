<?php
return [
    'id' => 'Test Application',    
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'extensions' => require(dirname(dirname(dirname(dirname(__DIR__)))) . '/extensions/extensions.php'),
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=tc_backend',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8'
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // THIS IS YOUR AUTH MANAGER
            'db'    => 'db',
            'assignmentTable' => 'user',
        ],
    ],
];
