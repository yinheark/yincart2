<?php

namespace core\rewrite\rules;


use kiwi\Kiwi;
use yii\web\UrlRule;

class RewriteUrlRule extends UrlRule
{
    public function init()
    {
        if ($this->name === null) {
            $this->name = __CLASS__;
        }
    }

    public function createUrl($manager, $route, $params)
    {
        /** @var \core\rewrite\models\UrlRewrite $urlRewrite */
        $urlRewrite = Kiwi::getUrlRewrite();
        $paramsPath = $urlRewrite->getParamsPath($params);
        $urlRewrite = $urlRewrite::findOne(['route' => $route, 'params' => $paramsPath]);

        if ($urlRewrite) {
            return $urlRewrite->request_path . ($this->suffix === null ? $manager->suffix : $this->suffix);
        }

        return false;  // this rule does not apply
    }

    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();
        $suffix = (string) ($this->suffix === null ? $manager->suffix : $this->suffix);
        if ($suffix !== '' && $pathInfo !== '') {
            $n = strlen($suffix);
            if (substr_compare($pathInfo, $suffix, -$n, $n) === 0) {
                $pathInfo = substr($pathInfo, 0, -$n);
                if ($pathInfo === '') {
                    return false;
                }
            } else {
                return false;
            }
        }

        /** @var \core\rewrite\models\UrlRewrite $urlRewriteClass */
        $urlRewriteClass = Kiwi::getUrlRewriteClass();
        $urlRewrite = $urlRewriteClass::findOne(['request_path' => $pathInfo]);

        if ($urlRewrite) {
            return [$urlRewrite->route, $urlRewrite->getParamsArray($urlRewrite->params)];
        }

        return false;  // this rule does not apply
    }
} 