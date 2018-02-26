<?php
$config = [
    'id' => 'question_spider',
    'timeZone'=>'Asia/Shanghai',
    'basePath' => dirname(dirname(__DIR__)),
    'bootstrap' => ['log'],
    'components' => include(__DIR__ . '/console_components.php'),
    'params' => include (__DIR__ . '/params.php'),
    'controllerNamespace' => 'app\modules\commands',
    'modules' => [
        'question_spider' => ['class' => 'app\modules\Module'],
    ],
    'aliases' => [
//        '@xxx' => '@app/../xxx',
    ],
];
return $config;
