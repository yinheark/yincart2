<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn) 
 * @Date 11/25/2014
 * @Time 11:48 AM
 */

namespace core\cms\models;

use kiwi\Kiwi;
class Block extends Cms
{
    const CMS_TYPE = 'block';

    public function getBlockPage($key){
        $content = '';
        $block = Kiwi::getBlock()->find()->where(['key'=>$key,'status'=>1])->one();
        if($block){
            $content = $block->content;
        }
        return $content;
    }
} 