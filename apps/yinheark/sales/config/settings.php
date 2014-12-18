<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 10/27/2014
 * @Time 3:01 PM
 */

return [
    'topMenu' => [
        'Dahan' => [
            'label' => '审核',
            'sort' => 30,
            'url' => ['cms/index'],
            'leftMenuKey' => 'Dahan',
            'items' => [
                'itemSales' => ['label' =>'商品审核', 'sort' => 1, 'url' => ['customerSales/index']],
                'itemPass' => ['label' =>'已审核商品', 'sort' => 2, 'url' => ['customerSales/checked']],
                'CustomerSales' => ['label' =>'销售人员审核', 'sort' => 3, 'url' => ['customerSeller/index']],
                'CustomerPass' => ['label' =>'已审核销售', 'sort' => 4, 'url' => ['customerSeller/checked']],
            ]
        ],
        'Cms' => [
            'label' => Yii::t('app', 'Cms'),
            'sort' => 30,
            'url' => ['cms/index'],
            'leftMenuKey' => 'Cms',
            'items' => [
                'article' => ['label' => '文章管理', 'sort' => 6, 'url' => ['article/index']],

            ]
        ],
    ],

    'leftMenu' => [
        'Dahan' => [
            'item' => [
                'label' =>  '商品审核',
                'sort' => 10,
                'items' => [
                    'itemSales' => ['label' =>'审核界面', 'sort' => 1, 'url' => ['customerSales/index']],
                    'itemPass' => ['label' =>'已审核列表', 'sort' => 2, 'url' => ['customerSales/checked']],
                ]
            ],
            'seller' => [
                'label' =>  '顾客审核',
                'sort' => 10,
                'items' => [
                    'CustomerSales' => ['label' =>'审核界面', 'sort' => 3, 'url' => ['customerSeller/index']],
                    'CustomerPass' => ['label' =>'已审核列表', 'sort' => 4, 'url' => ['customerSeller/checked']],
                ]
            ],
        ],
        'Cms' => [
            'Cms' => [
                'label' => Yii::t('app', 'Cms'),
                'sort' => 10,
                'items' => [
                    'article' => ['label' => '文章管理', 'sort' => 6, 'url' => ['article/index']],
                ]
            ],
        ],
    ],


];