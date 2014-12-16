<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 10/27/2014
 * @Time 3:01 PM
 */

return [
    'topMenu' => [
        'yincart' => [
            'label' => Yii::t('app', 'Mall'),
            'sort' => 30,
            'url' => ['item/index'],
            'leftMenuKey' => 'yincart',
            'items' => [
                'customer' => ['label' => Yii::t('app', 'Customer'), 'sort' => 60, 'url' => ['customer/index']],
            ]
        ],
    ],

    'leftMenu' => [
        'yincart' => [
            'customer' => [
                'label' => Yii::t('app', 'Customer'),
                'sort' => 30,
                'items' => [
                    'customer' => ['label' => Yii::t('app', 'Customer'), 'sort' => 20, 'url' => ['customer/index']],
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