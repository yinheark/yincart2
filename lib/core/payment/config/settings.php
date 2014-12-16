<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/16/2014
 * @Time 9:52 AM
 */

return [
    'config' => [
        'payment' => [         //tab
            'label' => Yii::t('app', 'Payment'),
            'sort' => 10,
            'groups' => [
                'alipay' => [  //group
                    'label' => Yii::t('app', 'AliPay'),
                    'sort' => 10,
                    'fields' => [
                        'pid' => [  //field
                            'label' => Yii::t('app', 'PID'),      //the label for input
                            'sort' => 10,
                            'type' => 'text',               //the input type: text, select, checkbox, radio
                            'value' => '2088711130584860',               //the default value
                        ],
                        'key' => [
                            'label' => Yii::t('app', 'Key'),
                            'sort' => 20,
                            'type' => 'text',
                            'value' => 'ydo97c7d33li675949edmjfxm9oxeyzc',
                        ],
                        'sellerEmail' => [
                            'label' => Yii::t('app', 'Seller Email'),
                            'sort' => 30,
                            'type' => 'text',
                            'value' => 'gaolujie1989@126.com',
                        ]
                    ]
                ],
            ],
        ],
    ],
];