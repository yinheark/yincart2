<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/16/2014
 * @Time 10:09 AM
 */

return [
    'backend' => [
        'customerSales' => 'extensions\sales\controllers\backend\CustomerSalesController',
        'customerSeller' => 'extensions\sales\controllers\backend\CustomerSellerController',
        'article' => 'extensions\sales\controllers\backend\ArticleController',
    ],
    'frontend' => [
        'customerSales' => 'extensions\sales\controllers\frontend\CustomerSalesController',
        'article' => 'extensions\sales\controllers\frontend\ArticleController',
        'customer' => 'extensions\sales\controllers\frontend\CustomerController',
    ],
];