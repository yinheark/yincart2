<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 10/27/2014
 * @Time 3:01 PM
 */

return [
    'topMenu' => [
        'Cms' => [
            'label' => Yii::t('app', 'Cms'),
            'sort' => 30,
            'url' => ['cms/index'],
            'leftMenuKey' => 'Cms',
            'items' => [
                'ad' => ['label' => Yii::t('app', 'Ad'), 'sort' => 1, 'url' => ['ad/index']],
                'block' => ['label' => Yii::t('app', 'Block'), 'sort' => 2, 'url' => ['block/index']],
                'page' => ['label' => Yii::t('app', 'Page'), 'sort' => 3, 'url' => ['page/index']],
            ]
        ],
    ],

    'leftMenu' => [
        'Cms' => [
            'Cms' => [
                'label' => Yii::t('app', 'Cms'),
                'sort' => 10,
                'items' => [
                    'ad' => ['label' => Yii::t('app', 'Ad'), 'sort' => 1, 'url' => ['ad/index']],
                    'block' => ['label' => Yii::t('app', 'Block'), 'sort' => 2, 'url' => ['block/index']],
                    'page' => ['label' => Yii::t('app', 'Page'), 'sort' => 3, 'url' => ['page/index']],
                ]
            ],
        ],
    ],

    'dataList' => [
        'categoryPosition' => [
            'label' => Yii::t('app', 'Category Position'),
            'sort' => 10,
            'isDB' => false,
            'value' => [
                'Last' => \Yii::t('app', 'Last Child'),
                'First' => \Yii::t('app', 'First Child'),
                'After' => \Yii::t('app', 'After Node'),
                'Before' => \Yii::t('app', 'Before Node'),
            ]
        ]
    ]
];