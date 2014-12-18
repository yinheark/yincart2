<?php
return [
    'language' => 'zh-CN',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'i18n' => [
            'translations' => [
                'kiwi' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en-US',
                    'basePath' => '@kiwi/messages',
                ],
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en-US',
                    'basePath' => '@common/messages',
                ]
            ]
        ],
        'request' => [
            'enableCookieValidation' => true,
            'enableCsrfValidation' => true,
            'cookieValidationKey' => 'kiwi-cookie',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'cache' => [
            'class' => 'yii\caching\ApcCache',
        ],
    ],
    'aliases' => [
        'modules' => dirname(dirname(__DIR__)) . '/common/modules',
        'webapp' => dirname(dirname(__DIR__)) . '/webapp',
        'upload' => dirname(dirname(__DIR__)) . '/upload',
        'lib' => dirname(dirname(dirname(__DIR__))) . '/lib',
        'apps' => dirname(dirname(dirname(__DIR__))) . '/apps',
        'themes' => dirname(dirname(dirname(__DIR__))) . '/themes',
    ],
    'bootstrap' => [
        'kiwi' => [
           'class' =>  'kiwi\Bootstrap',
           'codePools' =>  ['@lib', '@apps', '@themes'],
       ]
    ],
    'params' => [
        'imagePath' => '@upload',
        'imageDomain' => 'http://img.da.yincart.com',
    ]
];
