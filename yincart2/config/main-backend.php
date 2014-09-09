<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

return [
    'components' => [
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@yincart/themes/aceAdmin/views',
                    '@app/widgets' => '@yincart/themes/aceAdmin/widgets/views',
                ],
//                'baseUrl' => '@yincart/web/aceAdmin',
            ],
        ],
    ],
    'controllerMap' => [
        'category' => 'yincart\catalog\controllers\backend\CategoryController',
        'item' => 'yincart\catalog\controllers\backend\ItemController',
        'elfinder' => 'yincart\catalog\controllers\backend\ElfinderController',
        'customer' => 'yincart\Customer\controllers\backend\CustomerController',
        'order' => 'yincart\sales\controllers\backend\OrderController',
    ],
];