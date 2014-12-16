<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 10/27/2014
 * @Time 3:01 PM
 */

return [
    'topMenu' => [
//        'rewrite' => [
//            'label' => Yii::t('app', 'Url Rewrite'),
//            'sort' => 95,
//            'url' => ['rewrite/index'],
//            'leftMenuKey' => 'rewrite',
//        ],
    ],

    'leftMenu' => [
        'system' => [
            'rewrite' => [
                'label' => Yii::t('app', 'Url Rewrite'),
                'sort' => 30,
                'items' => [
                    'rewrite' => ['label' => Yii::t('app', 'Url Rewrite'), 'sort' => 10, 'url' => ['rewrite/index']],
                ]
            ],
        ],
    ],
];