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
                'payment' => ['label' => Yii::t('app', 'Payment'), 'sort' => 20, 'url' => ['payment/index']],
            ]
        ],
    ],

    'leftMenu' => [
        'yincart' => [
            'sales' => [
                'label' => Yii::t('app', 'Sales'),
                'sort' => 20,
                'items' => [
                    'payment' => ['label' => Yii::t('app', 'Payment'), 'sort' => 20, 'url' => ['payment/index']],
                ]
            ],
        ],
    ],

    'dataList' => [
        'paymentMethod' => [
            'label' => Yii::t('app', 'Payment Method'),
            'sort' => 10,
            'isDB' => false,
            'value' => [
                'AliPay' => \Yii::t('app', 'AliPay'),
            ]
        ]
    ]
];