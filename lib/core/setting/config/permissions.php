<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/16/2014
 * @Time 10:32 AM
 */

return [
    'default' => [     //module name
        'label' => Yii::t('app', '权限管理'),
        'sort' => 10,
        'groups' => [
            'config' => [     //controller name
                'label' => Yii::t('app', '配置管理'),
                'sort' => 10,
                'permissions' => [
                    'index' => [       //action name
                        'label' => Yii::t('app', '配置'),
                        'sort' => 10,
                    ],
                ]
            ],
        ]
    ]
];