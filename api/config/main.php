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
    'controllerNamespace' => 'api\controllers\v1',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'parsers' => [
                'enableCookieValidation' => false,
                'enableCsrfValidation' => false,
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
            'identityClass' => 'app\models\User',
        ],
        'response' => [
            'format' => yii\web\Response::FORMAT_JSON,
            'charset' => 'UTF-8',
        ],
    ],
    'params' => $params,
];
