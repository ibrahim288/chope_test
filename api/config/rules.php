<?php
$rules = [
    'POST api/v<version:\d+>/<controller:\w+>' => '<controller>/create',
    'GET api/v<version:\d+>/<controller:\w+>/<id:\d+>' => '<controller>/view',
    'PUT api/v<version:\d+>/<controller:\w+>/<id:\d+>' => '<controller>/update',
    'DELETE api/v<version:\d+>/<controller:\w+>/<id:\d+>' => '<controller>/delete',
];
return $rules;
