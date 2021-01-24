<?php

$container = getenv('ENV_CONTAINER');

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/params.php',
);

$rules = require(__DIR__ . '/rules.php');

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'enableCookieValidation' => false,
            'enableCsrfValidation' => false,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'ruleConfig' => ['class' => 'api\components\APIUrlRule'],
            'rules' => $rules,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'info'],
                ],
            ],
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=chope_test_db;dbname=chope_test_db',
            'username' => 'chope_test_user',
            'password' => 'chope_test_password',
            'charset' => 'utf8',
        ],
        'user' => [
            'identityClass' => 'api\models\User',
            'enableSession' => false,
            'enableAutoLogin' => false,
            'loginUrl' => null // Set the loginUrl property to be null to show a HTTP 403 error instead of redirecting to the login page.
        ],
        'response' => [
            'format' => yii\web\Response::FORMAT_JSON,
            'charset' => 'UTF-8',
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => "chope_test_redis",
            'port' => 6379,
        ],
    ],
    'params' => $params,
];
