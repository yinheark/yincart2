<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\assets;

use yincart\base\web\AssetBundle;
use yincart\Yincart;

class ElFinderAsset extends AssetBundle
{
    public $sourcePath = '@vendor/Studio-42/elFinder';
    public $css = [
        'css/common.css',
        'css/dialog.css',
        'css/toolbar.css',
        'css/navbar.css',
        'css/statusbar.css',
        'css/contextmenu.css',
        'css/cwd.css',
        'css/quicklook.css',
        'css/commands.css',
        'css/theme.css',
//        'jquery/ui-themes/smoothness/jquery-ui-1.8.18.custom.css',
    ];
    public $js = [
        //<!-- elfinder core -->
        'js/elFinder.js',
        'js/elFinder.version.js',
        'js/jquery.elfinder.js',
        'js/elFinder.resources.js',
        'js/elFinder.options.js',
        'js/elFinder.history.js',
        'js/elFinder.command.js',
        //<!-- elfinder ui -->
        'js/ui/overlay.js',
        'js/ui/workzone.js',
        'js/ui/navbar.js',
        'js/ui/dialog.js',
        'js/ui/tree.js',
        'js/ui/cwd.js',
        'js/ui/toolbar.js',
        'js/ui/button.js',
        'js/ui/uploadButton.js',
        'js/ui/viewbutton.js',
        'js/ui/searchbutton.js',
        'js/ui/sortbutton.js',
        'js/ui/panel.js',
        'js/ui/contextmenu.js',
        'js/ui/path.js',
        'js/ui/stat.js',
        'js/ui/places.js',
        //<!-- elfinder commands -->
        'js/commands/back.js',
        'js/commands/forward.js',
        'js/commands/reload.js',
        'js/commands/up.js',
        'js/commands/home.js',
        'js/commands/copy.js',
        'js/commands/cut.js',
        'js/commands/paste.js',
        'js/commands/open.js',
        'js/commands/rm.js',
        'js/commands/info.js',
        'js/commands/duplicate.js',
        'js/commands/rename.js',
        'js/commands/help.js',
        'js/commands/getfile.js',
        'js/commands/mkdir.js',
        'js/commands/mkfile.js',
        'js/commands/upload.js',
        'js/commands/download.js',
        'js/commands/edit.js',
        'js/commands/quicklook.js',
        'js/commands/quicklook.plugins.js',
        'js/commands/extract.js',
        'js/commands/archive.js',
        'js/commands/search.js',
        'js/commands/view.js',
        'js/commands/resize.js',
        'js/commands/sort.js',
        //<!-- elfinder languages -->
        'js/i18n/elfinder.en.js',
        'js/i18n/elfinder.zh_CN.js',
        'js/i18n/elfinder.ar.js',
        'js/i18n/elfinder.bg.js',
        'js/i18n/elfinder.ca.js',
        'js/i18n/elfinder.cs.js',
        'js/i18n/elfinder.de.js',
        'js/i18n/elfinder.es.js',
        'js/i18n/elfinder.fr.js',
        'js/i18n/elfinder.hu.js',
        'js/i18n/elfinder.jp.js',
        'js/i18n/elfinder.nl.js',
//        'js/i18n/elfinder.pl.js',
        'js/i18n/elfinder.pt_BR.js',
        'js/i18n/elfinder.ru.js',
        //<!-- elfinder dialog -->
        'js/jquery.dialogelfinder.js',
        //<!-- elfinder 1.x connector API support -->
        'js/proxy/elFinderSupportVer1.js',
        //<!-- elfinder custom extenstions -->
//        'extensions/jplayer/elfinder.quicklook.jplayer.js',
    ];

    public function init()
    {
        $this->depends[] = Yincart::$container->aceAdminAssetClass;
    }
} 