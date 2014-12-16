<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 * @Date 10/27/2014
 * @Time 3:01 PM
 */

return [
    'dataList' => [
        'itemPropType' => [
            'label' => Yii::t('app', 'Item Prop Types'),
            'sort' => 10,
            'isDB' => false,
            'value' => [
                '1' => \Yii::t('app', 'Text'),
                '2' => \Yii::t('app', 'Select'),
                '3' => \Yii::t('app', 'Checkbox'),
//                'radio' => \Yii::t('app', 'Radio'),
            ]
        ]
    ]
];