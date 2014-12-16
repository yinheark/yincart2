<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/16/2014
 * @Time 10:09 AM
 */

return [
    'backend' => [
        'page' => 'core\cms\controllers\backend\PageController',
        'ad' => 'core\cms\controllers\backend\AdController',
        'block' => 'core\cms\controllers\backend\BlockController',
    ],
    'frontend' => [
        'page' => 'core\cms\controllers\frontend\PageController',
        'ad' => 'core\cms\controllers\frontend\AdController',
        'block' => 'core\cms\controllers\frontend\BlockController',
    ],
];