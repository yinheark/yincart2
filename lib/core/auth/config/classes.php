<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/15/2014
 * @Time 10:28 AM
 */

return [
    'singleton' => [],
    'class' => [
        'admin' => 'core\auth\models\Admin',
        'adminModel' => 'core\auth\models\AdminModel',
        'role' => 'core\auth\models\Role',
        'roleModel' => 'core\auth\models\RoleModel',
        'actionAccessRule' => 'core\auth\filters\ActionAccessRule',
    ],
];
