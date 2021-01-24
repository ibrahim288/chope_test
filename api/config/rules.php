<?php
$rules = [
    'GET v<version:\d+>/<controller:\w+>' => '<controller>/read',
    'POST v<version:\d+>/<controller:\w+>' => '<controller>/create',
    'GET v<version:\d+>/<controller:\w+>/<id>' => '<controller>/view',
    'PUT v<version:\d+>/<controller:\w+>/<id>' => '<controller>/update',
    'DELETE v<version:\d+>/<controller:\w+>/<id>' => '<controller>/delete',
];
return $rules;
