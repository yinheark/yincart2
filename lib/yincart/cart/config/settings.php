<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 10/27/2014
 * @Time 3:01 PM
 */

return [
    'dataList' => [
        'categoryPosition' => [
            'label' => Yii::t('app', 'Category Position'),
            'sort' => 10,
            'isDB' => false,
            'value' => [
                'Last' => \Yii::t('app', 'Last Child'),
                'First' => \Yii::t('app', 'First Child'),
                'After' => \Yii::t('app', 'After Node'),
                'Before' => \Yii::t('app', 'Before Node'),
            ]
        ]
    ]
];