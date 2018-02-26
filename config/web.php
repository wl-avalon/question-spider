<?php
$config = [
    'id' => 'question_spider',
    'timeZone'=>'Asia/Shanghai',
    'basePath' => dirname(dirname(__DIR__)),
    'bootstrap' => ['log'],
    'aliases' => [
//        '@xxx' => '@app/../xxx',
    ],
    'controllerNamespace' => 'app\modules\controllers',
    'modules' => [
        'question_spider' => ['class' => 'app\modules\Module'],
    ],
    'components' => include(__DIR__ . '/components.php'),
    'params' => include (__DIR__ . '/params.php'),
];
return $config;
