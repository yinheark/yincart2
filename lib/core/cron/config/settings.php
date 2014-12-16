<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/16/2014
 * @Time 9:52 AM
 */

return [
    'topMenu' => [
//        'theme' => [
//            'label' => Yii::t('app', 'Themes'),
//            'sort' => 60,
//            'url' => ['theme/index'],
//            'leftMenuKey' => 'theme',
//        ],
    ],

    'leftMenu' => [
        'system' => [
            'cron' => [
                'label' => Yii::t('app', 'Cron'),
                'sort' => 40,
                'items' => [
                    'cron' => ['label' => Yii::t('app', 'Cron'), 'sort' => 20, 'url' => ['cron/index']],
                ]
            ],
        ],
    ],
];