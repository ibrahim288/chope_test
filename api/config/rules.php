<?php
$rules = [
    'GET v<version:\d+>/<controller:\w+>' => '<controller>/read',
    'POST v<version:\d+>/<controller:\w+>' => '<controller>/create',
    'GET v<version:\d+>/<controller:\w+>/<id:\d+>' => '<controller>/view',
    'PUT v<version:\d+>/<controller:\w+>/<id:\d+>' => '<controller>/update',
    'DELETE v<version:\d+>/<controller:\w+>/<id:\d+>' => '<controller>/delete',
];
return $rules;
