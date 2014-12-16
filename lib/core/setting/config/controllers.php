<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/16/2014
 * @Time 10:09 AM
 */

return [
    'backend' => [
        'setting' => 'core\setting\controllers\SettingController',
        'helper' => 'core\setting\controllers\HelperController',
        'data-list' => 'core\setting\controllers\DataListController',
        'elfinder' => [
            'class' => 'mihaildev\elfinder\Controller',
            'access' => ['@'], //глобальный доступ к фаил менеджеру @ - для авторизорованных , ? - для гостей , чтоб открыть всем ['@', '?']
            'disabledCommands' => ['netmount'], //отключение ненужных команд https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#commands
            'roots' => [
                [
                    'baseUrl' => Yii::$app->params['imageDomain'],
                    'basePath' => Yii::$app->params['imagePath'],
                    'path' => '/',
                    'name' => 'Upload'
                ],
            ]
        ],
    ],
    'frontend' => [],
];