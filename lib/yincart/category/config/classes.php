<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/15/2014
 * @Time 10:28 AM
 */

return [
    'singleton' => [],
    'class' => [
        'Category' => 'yincart\category\models\Category',
        'Tag' => 'yincart\category\models\Tag',
        'ItemCategory' => 'yincart\category\models\ItemTree',
        'ItemTag' => 'yincart\category\models\ItemTree',
        'CategoryBehavior' => 'yincart\category\behaviors\CategoryBehavior',
        'TagBehavior' => 'yincart\category\behaviors\TagBehavior',
        'ItemTree' => 'yincart\category\models\ItemTree',
    ],
];
