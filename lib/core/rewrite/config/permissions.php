<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/23/2014
 * @Time 12:49 PM
 */

return [
    'default' => [     //module name, if module is app, set default
        'label' => '权限管理',
        'sort' => 10,
        'groups' => [
            'article' => [     //controller name
                'label' => 'Url重写管理',
                'sort' => 10,
                'permissions' => [
                    'create' => [       //action name
                        'label' => '增加',
                        'sort' => 10,
                    ],
                    'update' => [
                        'label' => '修改',
                        'sort' => 20,
                    ],
                    'delete' => [
                        'label' => '删除',
                        'sort' => 30,
                    ],
                    'index' => [
                        'label' => '列表',
                        'sort' => 40,
                    ]
                ]
            ],
        ]
    ]
];