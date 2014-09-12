<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\widgets;

use yii\helpers\Html;
use yincart\base\base\Widget;
use yincart\Yincart;

/**
 * Class JqGrid
 * @package yincart\base\widgets
 * @author jeremy.zhou(gao_lujie@live.cn)
 */
class JqGrid extends Widget
{
    public function init()
    {
        $jsAssetFolder = $this->getView()->getAssetManager()->publish('@yincart/widgets/web/js');
        $this->getView()->registerJsFile($jsAssetFolder[1] . '/jq-grid.js', [Yincart::$container->aceAdminAssetClass]);
    }

    public function run()
    {
        $tableHtml = Html::tag('table', '', ['id' => 'grid-table', 'data' => $this->getTagData()]);
        $pagerHtml = Html::tag('div', '', ['id' => 'grid-pager']);
        return $tableHtml . $pagerHtml;
    }
} 