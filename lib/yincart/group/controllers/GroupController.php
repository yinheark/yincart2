<?php

namespace yincart\group\controllers;

use core\tree\controllers\TreeController;
use kiwi\Kiwi;
use Yii;


class groupController extends TreeController
{
    public function treeModelName()
    {
        return Kiwi::getGroupClass();
    }
}
