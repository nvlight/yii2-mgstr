<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'Ru-ru',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
//    'controllerMap' => [
//        'migrate' => [
//            'class' => 'yii\console\controllers\MigrateController',
//            'migrationPath' => null,
//            'migrationNamespaces' => [
//                'snewer\images\migrations',
//            ],
//        ],
//    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'mAaa_Y6pIHAnrVl_oMnfumVDbVtpoKz1',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' =>     $params['sw_host'],
                'username' => $params['sw_frommail'],
                'password' => $params['sw_pass'],
                'port' =>     $params['sw_port'],
                'encryption' => $params['sw_enc'],
            ],
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
        'db' => $db,
        //*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        //*/
        'storage' => [
            'class' => 'snewer\storage\StorageManager',
            'buckets' => [
                'images' => [
                    'class' => 'snewer\storage\drivers\FileSystemDriver',
                    'basePath' => '@webroot/uploads/images/',
                    'baseUrl' => '@web/uploads/images/'
                ],
            ]
        ],
    ],
    'modules' => [
        'str' => [
            'class' => 'app\modules\str\module',
            'layout' => 'main'
        ],
        'images' => [
            'class' => 'snewer\images\Module',
            'imagesStoreBucketName' => 'images',
            'controllerAccess' => [
                'class' => 'yii\filters\AccessControl',
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['?', '@']
                    ]
                ]
            ]
        ]
    ],
    'defaultRoute' => 'auth/index',
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
