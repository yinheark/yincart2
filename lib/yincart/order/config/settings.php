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
                'order' => ['label' => Yii::t('app', 'Order'), 'sort' => 10, 'url' => ['order/index']],
            ]
        ],
    ],

    'leftMenu' => [
        'yincart' => [
            'sales' => [
                'label' => Yii::t('app', 'Sales'),
                'sort' => 10,
                'items' => [
                    'order' => ['label' => Yii::t('app', 'Order'), 'sort' => 10, 'url' => ['order/index']],
                ]
            ],
        ],
    ],
];