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
                    '@app/widgets/views' => '@yincart/themes/aceAdmin/widgets/views',
                    '@yincart/widgets/views' => '@yincart/themes/aceAdmin/widgets/views',
                    '@yincart/catalog/widgets/views' => '@yincart/themes/aceAdmin/widgets/views',
                    '@yincart/customer/widgets/views' => '@yincart/themes/aceAdmin/widgets/views',
                    '@yincart/sales/widgets/views' => '@yincart/themes/aceAdmin/widgets/views',
                ],
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