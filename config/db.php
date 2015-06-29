<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2blog',
    'username' => 'root',
    'password' => 'password',
    'charset' => 'utf8mb4',
	'tablePrefix' => 'y2bg_',
	'emulatePrepare' => true,
	'enableSlaves' => false,
];
