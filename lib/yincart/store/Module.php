<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 2014/11/10
 * @Time 20:11
 */

namespace yincart\store;


class Module extends \kiwi\base\Module
{
    public $version = 'v0.1.0';

    public static $active = false;

    public static $depends = ['yincart_category', 'yincart_item'];

} 