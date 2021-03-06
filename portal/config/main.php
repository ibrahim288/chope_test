<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'chope-test-portal',
    'name' => 'Chope Test',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'portal\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-portal',
            'cookieValidationKey' => 'fsjbm1fBbYOc5LbachM4eh-P2Tvgit4H',
        ],
        'user' => [
            'identityClass' => 'portal\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-portal', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the portal
            'name' => 'advanced-portal',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'params' => $params,
];
