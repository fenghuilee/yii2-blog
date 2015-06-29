<?php

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
	'timeZone' => 'Asia/Shanghai',
    'components' => [
		'urlManager' => [
			'class' => 'yii\web\UrlManager',
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'suffix' => '.html',
			'rules' => [
				''=>'site/index',
				'admin'=>'admin/default/index',
				
				'category/<alias:.+>'=>'site/category',
				'<yyyy:\d{4}>/<mm:\d{2}>/<dd:\d{2}>/<alias:.+>'=>'site/article',
				
				'<action:\w+>'=>'site/<action>',
				'<module:\w+>/<action:\w+>'=>'<module>/default/<action>',
				
				'<module:\w+>/<controller:\w+>-<action:\w+>'=>'<module>/<controller>/<action>',
				
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				'<module:\w+>/<controller:\w+>/<action:\w+>'=>'<module>/<controller>/<action>',
			],
		],
		'smarty' => [
            'class' => 'yii\smartyviewer\SmartyViewer',
            'themeName' => 'amazeui',
            'options' => [
                'left_delimiter' => '<{',
                'right_delimiter' => '}>',
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'zZx36C8j4HfIHyQ8LG5oCDNHZ7cjSwti',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\common\models\User',
            'enableAutoLogin' => true,
			'loginUrl' => [
				'/admin/login',
			],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => require(__DIR__ . '/db.php'),
    ],
	'modules' => [
		'admin' => [
			'class' => 'app\modules\admin\Module',
			'as AccessBehavior' => [
				'class' => '\app\common\components\AccessBehavior'
			],
		],
	],
    'params' => require(__DIR__ . '/params.php'),
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
