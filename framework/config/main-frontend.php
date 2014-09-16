<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

return [
    'components' => [
        'user' => [
            'identityClass' => 'yincart\customer\models\Customer',
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@yincart/themes/garbini/views',
                    '@app/widgets/views' => '@yincart/themes/garbini/widgets/views',
                    '@yincart/widgets/views' => '@yincart/themes/garbini/widgets/views',
                    '@yincart/catalog/widgets/views' => '@yincart/themes/garbini/widgets/views',
                    '@yincart/customer/widgets/views' => '@yincart/themes/garbini/widgets/views',
                    '@yincart/sales/widgets/views' => '@yincart/themes/garbini/widgets/views',
                ],
            ],
        ],
    ],
    'controllerMap' => [
        'item' => 'yincart\catalog\controllers\frontend\ItemController',
        'cart' => 'yincart\sales\controllers\frontend\CartController',
        'account' => 'yincart\customer\controllers\frontend\AccountController',
    ],
];