<?php

$vendorDir = __DIR__;

return array (
	'bootstrap' => 
	array (
		'name' => 'bootstrap',
		'version' => '2.0.0.0-alpha',
		'alias' => 
		array (
			'@yii/bootstrap' => $vendorDir . '/bootstrap',
		),
	),
	'urlasset' => 
	  array (
		'name' => 'urlasset',
		'version' => '1.0',
		'alias' => 
		array (
		  '@yii/UrlAsset' => $vendorDir . '/urlasset',
		),
	  ),
	'adminUi' => 
	array (
		'name' => 'adminUi',
		'version' => '1.0',
                'bootstrap' => 'yii\\adminUi\\AdminUiBootstrap',
		'alias' => 
		array (
			'@yii/adminUi' => $vendorDir . '/adminUi',
			'@vendor/adminUi/assets/' => $vendorDir . '/adminUi/assets',
			'@backend/themes/adminui' => $vendorDir . '/adminUi/themes/',
		),
	),
	'gii' => 
	array (
		'name' => 'gii',
		'version' => '2.0.0.0-alpha',
		'alias' => 
		array (
			'@yii/gii' => $vendorDir . '/gii',
		),
	),
	'debug' => 
	array (
		'name' => 'debug',
		'version' => '2.0.0.0-alpha',
		'alias' => 
		array (
			'@yii/debug' => $vendorDir . '/debug',
		),
	),
	'apidoc' => 
	array (
		'name' => 'apidoc',
		'version' => '2.0.0.0-alpha',
		'alias' => 
		array (
			'@yii/apidoc' => $vendorDir . '/apidoc',
		),
	),
	'apidoc' => 
	array (
		'name' => 'apidoc',
		'version' => '2.0.0.0-alpha',
		'alias' => 
		array (
			'@yii/apidoc' => $vendorDir . '/apidoc',
		),
	),  
	'TimescityModel' => 
	array (
		'name' => 'Timescity Model',
		'version' => '1.0.0.0',
		'alias' => 
		array (
			'@TC' => $vendorDir .'/TC',
		),
	),	
	'MetaData' => 
	array (
		'name' => 'Metadata',
		'version' => '1.0.0.0',
		'alias' => 
		array (
			'@yii/metadata' => $vendorDir .'/metadata',
		),
	),
);
