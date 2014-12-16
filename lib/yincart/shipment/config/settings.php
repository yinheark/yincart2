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
//            'url' => ['item/index'],
            'leftMenuKey' => 'yincart',
            'items' => [
                'shipment' => ['label' => Yii::t('app', 'Shipment'), 'sort' => 30, 'url' => ['shipment/index']],
            ]
        ],
    ],

    'leftMenu' => [
        'yincart' => [
            'sales' => [
                'label' => Yii::t('app', 'Sales'),
                'sort' => 20,
                'items' => [
                    'shipment' => ['label' => Yii::t('app', 'Shipment'), 'sort' => 30, 'url' => ['shipment/index']],
                ]
            ],
        ],
    ],

    'dataList' => [
    ]
];