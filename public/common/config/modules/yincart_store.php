<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/15/2014
 * @Time 9:42 AM
 */

return [
    'yincart_store' => [
        'class' => 'yincart\store\Module',
        'active' => false,
        'depends' => ['yincart_category', 'yincart_item'],
        'config' => [],
    ]
];