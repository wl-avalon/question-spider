<?php
$config = [
    'id' => 'question_spider',
    'timeZone'=>'Asia/Shanghai',
    'basePath' => dirname(dirname(__DIR__)),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'components' => include(__DIR__ . '/console_components.php'),
    'params' => include (__DIR__ . '/params.php'),
    'modules' => [
        'question_spider' => ['class' => 'app\modules\Module'],
    ],
    'aliases' => [
//        '@rrxframework' => '@app/rrxframework',
    ],
];
return $config;
