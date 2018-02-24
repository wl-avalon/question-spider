<?php
$config = [
    'id' => 'study_palace',
    'timeZone'=>'Asia/Shanghai',
    'basePath' => dirname(dirname(__DIR__)),
    'bootstrap' => ['log'],
    'aliases' => [
//        '@rrxframework' => '@app/../rrxframework',
    ],
    'modules' => [
        'study_palace' => ['class' => 'app\modules\Module'],
    ],
    'components' => include(__DIR__ . '/components.php'),
    'params' => include (__DIR__ . '/params.php'),
];
return $config;
