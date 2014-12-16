<?php
/**
 * Created by Changhai.Lin.
 * Date: 11/19/2014 10:46 AM
 */
namespace core\theme;

use kiwi\Kiwi;
use yii\helpers\ArrayHelper;

/**
 * @description :
 * Class Module
 *
 * @method getViews();
 *
 * @package core\theme
 * @author: Changhai.Lin <changhai.lin@jago-ag.cn>
 */
class Module extends \kiwi\base\Module
{
    public $version = 'v0.1.0';

    public static $config = ['views'];

    public function bootstrap($app)
    {
        $views = $this->getViews();
        /** @var \core\theme\models\Theme $theme */
        $themes = Kiwi::getTheme()->find()->where(['is_active' => 1, 'scope' => \Yii::$app->id])->orderBy('sort')->all();
        foreach ($themes as $theme) {
            if (isset($views[$theme->key])) {
                $this->loadViewPathMap($views[$theme->key]);
            }
        }
        $this->loadViewPathMap($views['default']);
    }

    protected function loadViewPathMap($viewPathMap)
    {
        if (!($theme = \Yii::$app->getView()->theme)) {
            $theme = \Yii::$app->getView()->theme = \Yii::createObject(['class' => 'yii\base\Theme', 'basePath' => '@app/views']);
        }
        if (isset($viewPathMap['baseUrl']) && $viewPathMap['baseUrl']) {
            $theme->setBaseUrl($viewPathMap['baseUrl']);
        }
        if (isset($viewPathMap['basePath']) && $viewPathMap['basePath']) {
            $theme->setBasePath($viewPathMap['basePath']);
        }
        if (isset($viewPathMap['pathMap']) && $viewPathMap['pathMap']) {
            foreach ($viewPathMap['pathMap'] as $from => $to) {
                $to = array_reverse($to);
                if (isset($theme->pathMap[$from])) {
                    if (!is_array($theme->pathMap[$from])) {
                        $theme->pathMap[$from] = [$theme->pathMap[$from]];
                    }
                    if (is_array($to)) {
                        $theme->pathMap[$from] = ArrayHelper::merge( $theme->pathMap[$from], $to);
                    } else if (!in_array($to, $theme->pathMap[$from])) {
                        $theme->pathMap[$from][] = $to;
                    }
                } else {
                    $theme->pathMap[$from] = is_array($to) ? $to : [$to];
                }
            }
        }
    }
} 