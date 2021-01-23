<?php
namespace api\components;

use Yii;
use yii\web\UrlRule;
use yii\base\InvalidRouteException;

class APIUrlRule extends UrlRule
{
    public function parseRequest($manager, $request)
    {
        $path = explode('/', $request->pathInfo);
        if (count($path) < 2) {
            throw new InvalidRouteException();
        }

        Yii::$app->controllerNamespace = "api\controllers\\" . $path[0];
        Yii::$app->request->enableCsrfValidation = false;

        return parent::parseRequest($manager, $request);
    }
}
