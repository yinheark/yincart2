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
        'modules' => dirname(dirname(dirname(dirname(__DIR__)))) . '/lib',
//        'webapp' => dirname(dirname(__DIR__)) . '/webapp',
        'upload' => dirname(dirname(__DIR__)) . '/upload',
    ],
    'bootstrap' => [
        'kiwi' => [
           'class' =>  'kiwi\Bootstrap',
           'codePools' =>  ['@modules'],
       ]
    ],
    'params' => [
        'imagePath' => '@upload',
        'imageDomain' => 'http://img.da.yincart.com',
    ]
];
