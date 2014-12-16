<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/15/2014
 * @Time 9:42 AM
 */

return [
    'core_auth' => [
        'class' => 'core\auth\Module',
        'active' => true,
        'depends' => ['core_user'],
        'config' => ['permissions', 'admins'],
    ]
];