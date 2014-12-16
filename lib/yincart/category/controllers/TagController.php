<?php

namespace yincart\category\controllers;

use core\tree\controllers\TreeController;
use kiwi\Kiwi;
use Yii;


class TagController extends TreeController
{
    public function treeModelName()
    {
        return Kiwi::getTagClass();
    }

    public function treeModel(){
        return Kiwi::getTag();
    }
}
