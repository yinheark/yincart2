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
                    '@app/views' => '@yincart/themes/garbini/views',
                    '@app/widgets' => '@yincart/themes/garbini/widgets/views',
                ],
//                'baseUrl' => '@yincart/web/aceAdmin',
            ],
        ],
    ],
    'controllerMap' => [
        'item' => 'yincart\catalog\controllers\frontend\ItemController',
        'cart' => 'yincart\sales\controllers\frontend\CartController',
        'account' => 'yincart\customer\controllers\frontend\AccountController',
    ],
];