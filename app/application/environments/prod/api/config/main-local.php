<?php
$config = [];

$config['components']['db'] = [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=tc_backend',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
			'tablePrefix' => 'tc_',
        ];
return $config;
