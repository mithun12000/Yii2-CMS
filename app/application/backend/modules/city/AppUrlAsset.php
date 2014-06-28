<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */


namespace backend\modules\city;

use Yii\UrlAsset\component\UrlAsset;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppUrlAsset extends UrlAsset
{    
    public $url = [
        [
            [
                'label' => 'City', 
                'url' => ['/city'],
                'linkOptions'=>[
                    'class' => 'fa fa-group',
                ],
                 'items' => [
                    [
                        'label' => 'City', 
                        'url' => ['/city'],
                        'linkOptions'=>[
                            'class' => 'fa fa-group',
                        ]
                    ],  
                    [
                        'label' => 'City Trash', 
                        'url' => ['/city/city-trash/index'],
                        'linkOptions'=>[
                            'class' => 'fa fa-trash-o',
                        ]
                    ],
                ]
            ]
        ]
    ];
    
    public $actionmap = [
        [
            'module'    => [
                [
                    'name'  => 'City',
                    'controller' => [
                        [
                            'name' => 'City',
                            'actions' => ['index','login','logout'],
                        ]
                    ],
                ]
            ]
        ]
    ];
    
    public $module = 'city';
}