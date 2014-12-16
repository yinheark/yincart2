<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 10/27/2014
 * @Time 3:01 PM
 */

return [
    'topMenu' => [
//        'auth' => [
//            'label' => Yii::t('app', 'Auth'),
//            'sort' => 90,
//            'url' => ['user/index'],
//            'leftMenuKey' => 'auth',
//        ],
    ],

    'leftMenu' => [
        'system' => [
            'auth' => [
                'label' => Yii::t('app', 'Auth'),
                'sort' => 20,
                'items' => [
                    'user' => ['label' => Yii::t('app', 'Admins'), 'sort' => 10, 'url' => ['user/index']],
                    'role' => ['label' => Yii::t('app', 'Roles'), 'sort' => 20, 'url' => ['role/index']],
                ]
            ],
        ],
    ],
];