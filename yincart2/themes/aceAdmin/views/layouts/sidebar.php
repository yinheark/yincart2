<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

use yii\helpers\Url;
?>

<div id="sidebar" class="sidebar responsive">
    <script type="text/javascript">
        try {
            ace.settings.check('sidebar', 'fixed')
        } catch (e) {
        }
    </script>

    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <button class="btn btn-success">
                <i class="ace-icon fa fa-signal"></i>
            </button>

            <button class="btn btn-info">
                <i class="ace-icon fa fa-pencil"></i>
            </button>

            <!-- #section:basics/sidebar.layout.shortcuts -->
            <button class="btn btn-warning">
                <i class="ace-icon fa fa-users"></i>
            </button>

            <button class="btn btn-danger">
                <i class="ace-icon fa fa-cogs"></i>
            </button>

            <!-- /section:basics/sidebar.layout.shortcuts -->
        </div>

        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>

            <span class="btn btn-info"></span>

            <span class="btn btn-warning"></span>

            <span class="btn btn-danger"></span>
        </div>
    </div>
    <!-- /.sidebar-shortcuts -->

    <ul class="nav nav-list">
        <li class="">
            <a href="#">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Dashboard </span>
            </a>

            <b class="arrow"></b>
        </li>

        <li class="active">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-gift"></i>
                <span class="menu-text"> Catalog </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">

                <li class="">
                    <a href="<?= Url::to(['category/index']) ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Category
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="<?= Url::to(['item/index']) ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Product
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="<?= Url::to(['elfinder/index']) ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Image Space
                    </a>

                    <b class="arrow"></b>
                </li>
            </ul>
        </li>

        <li class="active">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-gift"></i>
                <span class="menu-text"> Customer </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">

                <li class="">
                    <a href="<?= Url::to(['customer/index']) ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Customer
                    </a>

                    <b class="arrow"></b>
                </li>

            </ul>
        </li>

        <li class="active">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-gift"></i>
                <span class="menu-text"> Sales </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">

                <li class="">
                    <a href="<?= Url::to(['order/index']) ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Order
                    </a>

                    <b class="arrow"></b>
                </li>

            </ul>
        </li>
    </ul>
    <!-- /.nav-list -->

    <!-- #section:basics/sidebar.layout.minimize -->
    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left"
           data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>

    <!-- /section:basics/sidebar.layout.minimize -->
    <script type="text/javascript">
        try {
            ace.settings.check('sidebar', 'collapsed')
        } catch (e) {
        }
    </script>
</div>