<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

return [
    'components' => [
        'i18n' => [
            'translations' => [
                'yincart' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en-US',
                    'basePath' => '@yincart/messages',
                ]
            ]
        ],
        'request' => [
            'enableCookieValidation' => true,
            'enableCsrfValidation' => true,
            'cookieValidationKey' => 'yincart-cookie',
        ],
    ],
    'params' => [
        'imagePath' => '@common/files',
        'imageDomain' => 'http://image.y.com',
    ]
];