<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 11/25/2014
 * @Time 11:56 AM
 */

namespace core\cms\controllers\backend;

use kiwi\Kiwi;
class BlockController extends CmsController
{
    public function init()
    {
        $this->getView()->params['topMenuKey'] = 'Cms';
        $this->getView()->params['leftMenuKey'] = 'Cms';
    }

    public function getModel()
    {
        return Kiwi::getBlock();
    }
    public function getModelClass(){
        return Kiwi::getBlockClass();
    }
} 