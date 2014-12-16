<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/16/2014
 * @Time 10:32 AM
 */

return [
    'default' => [     //module name, if module is app, set default
        'label' => Yii::t('app', '商品管理'),
        'sort' => 10,
        'groups' => [
            'category' => [     //controller name
                'label' => Yii::t('app', '商品管理'),
                'sort' => 10,
                'permissions' => [
                    'create' => [       //action name
                        'label' => Yii::t('app', '增加'),
                        'sort' => 10,
                    ],
                    'update' => [
                        'label' => Yii::t('app', '修改'),
                        'sort' => 20,
                    ],
                    'delete' => [
                        'label' => Yii::t('app', '删除'),
                        'sort' => 30,
                    ],
                    'list' => [
                        'label' => Yii::t('app', '列表'),
                        'sort' => 40,
                    ]
                ]
            ]
        ]
    ]
];