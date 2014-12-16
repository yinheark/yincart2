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
                'refund' => ['label' => Yii::t('app', 'Refund'), 'sort' => 40, 'url' => ['refund/index']],
            ]
        ],
    ],

    'leftMenu' => [
        'yincart' => [
            'sales' => [
                'label' => Yii::t('app', 'Sales'),
                'sort' => 20,
                'items' => [
                    'refund' => ['label' => Yii::t('app', 'Refund'), 'sort' => 40, 'url' => ['refund/index']],
                ]
            ],
        ],
    ],

    'dataList' => [
    ]
];