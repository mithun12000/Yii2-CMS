<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */


namespace backend\modules\country;

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
                'label' => 'Country', 
                'url' => ['/country'],
                'linkOptions'=>[
                    'class' => 'fa fa-group',
                ],
                 'items' => [
                    [
                        'label' => 'Country', 
                        'url' => ['/country'],
                        'linkOptions'=>[
                            'class' => 'fa fa-group',
                        ]
                    ],  
                    [
                        'label' => 'Country Trash', 
                        'url' => ['/country/country-trash/index'],
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
                    'name'  => 'Country',
                    'controller' => [
                        [
                            'name' => 'Country',
                            'actions' => ['index','login','logout'],
                        ]
                    ],
                ]
            ]
        ]
    ];
    
    public $module = 'country';
}