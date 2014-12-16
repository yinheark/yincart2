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
            'theme' => [
                'label' => Yii::t('app', 'Themes'),
                'sort' => 40,
                'items' => [
                    'theme' => ['label' => Yii::t('app', 'Themes'), 'sort' => 20, 'url' => ['theme/index']],
                ]
            ],
        ],
    ],

    'dataList' => [
        'themeScope' => [
            'label' => Yii::t('app', 'theme Scope'),
            'sort' => 10,
            'value' => [
                'backend' => Yii::t('app', 'Backend'),
                'frontend' => Yii::t('app', 'Frontend'),
            ]
        ]
    ]
];