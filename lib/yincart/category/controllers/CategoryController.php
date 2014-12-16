<?php

namespace yincart\category\controllers;

use core\tree\controllers\TreeController;
use kiwi\Kiwi;
use Yii;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends TreeController
{
    public function treeModelName()
    {
        return Kiwi::getCategoryClass();
    }


    public function treeModel(){
        return Kiwi::getCategory();
    }
}
