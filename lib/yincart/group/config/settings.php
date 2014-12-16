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
                'group' => ['label' => Yii::t('app', 'Customer Group'), 'sort' => 70, 'url' => ['group/index']],
            ]
        ],
    ],

    'leftMenu' => [
        'yincart' => [
            'customer' => [
                'label' => Yii::t('app', 'Customer'),
                'sort' => 30,
                'items' => [
                    'group' => ['label' => Yii::t('app', 'Customer Group'), 'sort' => 30, 'url' => ['group/index']],
                ]
            ],
        ],
    ],
];