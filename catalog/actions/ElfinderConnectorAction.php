<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\catalog\actions;

use yii\base\Action;

class ElfinderConnectorAction extends Action
{
    public function run()
    {
        $connectorPath = \Yii::getAlias('@vendor/Studio-42/elFinder/php');
        include($connectorPath . DIRECTORY_SEPARATOR . 'elFinderConnector.class.php');
        include($connectorPath . DIRECTORY_SEPARATOR . 'elFinder.class.php');
        include($connectorPath . DIRECTORY_SEPARATOR . 'elFinderVolumeDriver.class.php');
        include($connectorPath . DIRECTORY_SEPARATOR . 'elFinderVolumeLocalFileSystem.class.php');

        $opts = array(
            'locale' => '',
            'roots'  => array(
                array(
                    'driver' => 'LocalFileSystem',
                    'path'   => \Yii::getAlias(\Yii::$app->params['imagePath']),
                    'URL'    => \Yii::$app->params['imageDomain'],
                )
            )
        );

        $connector = new \elFinderConnector(new \elFinder($opts));
        $connector->run();
    }
} 