<?php
/**
 * @author Lujie.Zhou(gao_lujie@live.cn)
 * @Date 10/15/2014
 * @Time 9:59 AM
 */

namespace core\setting;

use kiwi\Kiwi;
use yii\helpers\ArrayHelper;


/**
 * Class Module
 *
 * @method array getSettings()
 *
 * @package core\setting
 * @author Lujie.Zhou(gao_lujie@live.cn)
 */
class Module extends \kiwi\base\Module
{
    public $version = 'v0.2.0';

    public static $config =   ['settings'];
    protected $_topMenu = [];

    protected $_leftMenu = [];

    protected $_dataList = [];

    protected $_config = [];

    public $menuChildrenName = 'items';

    public $configChildrenNames = ['groups', 'fields'];

    public function getTopMenu()
    {
        if (!$this->_topMenu) {
            $settings = $this->getSettings();
            if (!isset($settings['topMenu']))
                return [];
            $this->_topMenu = $this->sortArray($settings['topMenu'], $this->menuChildrenName);
        }
        return $this->_topMenu;
    }

    public function getLeftMenu($name)
    {
        if (!isset($this->_leftMenu[$name])) {
            $settings = $this->getSettings();
            if (!isset($settings['leftMenu']) || !isset($settings['leftMenu'][$name]))
                return [];
            $this->_leftMenu[$name] = $this->sortArray($settings['leftMenu'][$name], $this->menuChildrenName);
        }
        return $this->_leftMenu[$name];
    }

    public function getDataList($type = '')
    {
        if (!$this->_dataList) {
            $settings = $this->getSettings();
            if (!isset($settings['dataList']))
                return [];
            $this->_dataList = $this->sortArray($settings['dataList']);
        }
        return isset($this->_dataList[$type]) ? $this->_dataList[$type] : $this->_dataList;
    }

    /**
     * get config from setting file and sort
     * @return array
     */
    public function getConfigFromFile()
    {
        if (!$this->_config) {
            $settings = $this->getSettings();
            if (!isset($settings['config']))
                return [];
            $this->_config = $this->sortArray($settings['config'], $this->configChildrenNames);
        }
        return $this->_config;
    }

    protected function sortArray($array, $childrenNames = '')
    {
        uasort($array, function ($a, $b) {
            if (!isset($a['sort']) || !isset($b['sort'])) {
                return 0;
            }
            if ($a['sort'] == $b['sort']) {
                return 0;
            }
            return ($a['sort'] < $b['sort']) ? -1 : 1;
        });

        if ($childrenNames) {
            if (is_array($childrenNames)) {
                $name = array_shift($childrenNames);
            } else {
                $name = $childrenNames;
            }

            foreach ($array as $key => $childArray) {
                if (isset($childArray[$name])) {
                    $array[$key][$name] = $this->sortArray($array[$key][$name], $childrenNames);
                }
            }
        }

        return $array;
    }
} 