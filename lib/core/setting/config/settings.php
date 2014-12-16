<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/16/2014
 * @Time 9:52 AM
 */

return [
    'topMenu' => [
        'system' => [
            'label' => Yii::t('app', 'System'),
            'sort' => 10,
            'url' => ['setting/index'],
            'leftMenuKey' => 'system',
            'items' => [
                'setting' => ['label' => Yii::t('app', 'Configuration'), 'sort' => 10, 'url' => ['setting/index']],
                'user' => ['label' => Yii::t('app', 'Auth'), 'sort' => 20, 'url' => ['user/index']],
                'rewrite' => ['label' => Yii::t('app', 'Url Rewrite'), 'sort' => 30, 'url' => ['rewrite/index']],
                'theme' => ['label' => Yii::t('app', 'Themes'), 'sort' => 40, 'url' => ['theme/index']],
            ]
        ],
    ],

    'leftMenu' => [
        'system' => [
            'setting' => [
                'label' => Yii::t('app', 'Configuration'),
                'sort' => 10,
                'items' => [
                    'setting' => ['label' => Yii::t('app', 'Configuration'), 'sort' => 10, 'url' => ['setting/index']],
                    'dataList' => ['label' => Yii::t('app', 'DataList'), 'sort' => 20, 'url' => ['data-list/index']],
                ]
            ],
        ],
    ],

    'config' => [
        'system' => [         //tab
            'label' => Yii::t('app', 'Settings'),
            'sort' => 10,
            'groups' => [
                'website' => [  //group
                    'label' => Yii::t('app', 'Website'),
                    'sort' => 10,
                    'fields' => [
                        'websiteName' => [  //field
                            'label' => Yii::t('app', 'WebSite Name'),      //the label for input
                            'sort' => 10,
                            'type' => 'text',               //the input type: text, select, checkbox, radio
                            'value' => 'xxx',               //the default value
                        ],
                        'theme' => [
                            'label' => Yii::t('app', 'Theme'),
                            'sort' => 20,
                            'type' => 'text',
                            'value' => 'xxx',
                        ],
                    ]
                ],
                'security' => [
                    'label' => Yii::t('app', 'Security'),
                    'sort' => 20,
                    'fields' => [
                        'crsf' => [
                            'label' => Yii::t('app', 'CSRF Token'),
                            'sort' => 10,
                            'type' => 'select',
                            //if type is text, it will be ignored
                            //if type is select or checkbox or radio, it need a array as the data
                            'data' => ['1' => 'Yes', '0' => 'No'],
                            //it will call this function to get data, Kiwi::getClass()->func();
                            //'data' => 'class/func',
                            'value' => 'xxx',
                        ]
                    ]
                ]
            ],
        ],
        'config' => [         //tab
            'label' => Yii::t('app', 'Settings2'),
            'sort' => 20,
            'groups' => [
                'website' => [  //group
                    'label' => Yii::t('app', 'Website2'),
                    'sort' => 10,
                    'fields' => [
                        'websiteName2' => [  //field
                            'label' => Yii::t('app', 'WebSite Name'),      //the label for input
                            'sort' => 10,
                            'type' => 'text',               //the input type: text, select, checkbox, radio
                            'value' => 'xxx',               //the default value
                        ],
                        'theme2' => [
                            'label' => Yii::t('app', 'Theme'),
                            'sort' => 20,
                            'type' => 'text',
                            'value' => 'xxx',
                        ],
                    ]
                ],
                'security' => [
                    'label' => Yii::t('app', 'Security2'),
                    'sort' => 20,
                    'fields' => [
                        'crsf2' => [
                            'label' => Yii::t('app', 'CSRF Token'),
                            'sort' => 10,
                            'type' => 'checkbox',
                            //if type is text, it will be ignored
                            //if type is select or checkbox or radio, it need a array as the data
                            'data' => ['1' => 'Yes', '0' => 'No'],
                            //it will call this function to get data, Kiwi::getClass()->func();
                            //'data' => 'class/func',
                            'value' => ['1'],
                        ]
                    ]
                ]
            ],
        ],
    ],

    'dataList' => [
        'boolean' => [
            'label' => Yii::t('app', 'Boolean'),
            'sort' => 10,
            'isDB' => true,
            'value' => [
                0 => \Yii::t('app', '否'),
                1 => \Yii::t('app', '是'),
            ]
        ],
        'xxx' => [
            'label' => Yii::t('app', 'XXXXXX'),
            'sort' => 10,
            'isDB' => true,
            'value' => [
                0 => \Yii::t('app', '1'),
                1 => \Yii::t('app', '2'),
            ]
        ]
    ]
];