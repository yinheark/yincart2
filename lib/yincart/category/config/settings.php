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
                'category' => ['label' => Yii::t('app', 'Category'), 'sort' => 3, 'url' => ['category/index']],
                'tag' => ['label' => Yii::t('app', 'Tag'), 'sort' => 3, 'url' => ['tag/index']],
            ]
        ],
    ],

    'leftMenu' => [
        'yincart' => [
            'catalog' => [
                'label' => Yii::t('app', 'Catalog'),
                'sort' => 10,
                'items' => [
                    'category' => ['label' => Yii::t('app', 'Category'), 'sort' => 10, 'url' => ['category/index']],
                    'tag' => ['label' => Yii::t('app', 'Tag'), 'sort' => 10, 'url' => ['tag/index']],
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