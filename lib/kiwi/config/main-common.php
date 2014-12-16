<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/14/2014
 * @Time 14:23 AM
 */

/**
 * the kiwi common config file
 */
return [
    'aliases' => [
        'kiwi' => dirname(__DIR__),
        'extensions' => dirname(dirname(__DIR__)) . '/extensions',
        'upload' => dirname(dirname(__DIR__)) . '/upload',
    ],
    'bootstrap' => [
       'kiwi' =>  'kiwi\Bootstrap',
    ],
    'components' => [
        'i18n' => [
            'translations' => [
                'kiwi' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en-US',
                    'basePath' => '@kiwi/messages',
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
    'params' => [
        'imagePath' => '@upload',
        'imageDomain' => 'http://img.da.yincart.com',
    ]
];