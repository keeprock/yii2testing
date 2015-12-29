<?php
$params = require(__DIR__ . '/params.php');

$additional_config = include(__DIR__ . '/additional_config.php');

$config = [
    'id' => 'crm-fckrasnodar',
    'name' => 'Информационная система ФК Краснодар',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru-RU',
    'components' => [
        'assetManager' => [
            'class' => 'yii\web\AssetManager',
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js' => [
                        YII_ENV_DEV ? 'jquery.js' : 'jquery.min.js'
                    ]
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [
                        YII_ENV_DEV ? 'css/bootstrap.css' : 'css/bootstrap.min.css',
                    ]
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js' => [
                        YII_ENV_DEV ? 'js/bootstrap.js' : 'js/bootstrap.min.js',
                    ]
                ]
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '6evQ8GS3AOdH0s20sXS9bPHKCuqlt0em',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
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
        'urlManager' => [
            'enablePrettyUrl' => true,
//            'enableStrictParsing' => true,
            'showScriptName' => false,
//            'rules' => [
//                        ['class' => 'yii\rest\UrlRule','controller' => 'apicrm/persondef']
//                    ],
        ],
    ],
    'modules' => [
        'api' => [
            'class' => 'app\modules\api\Module',
        ],
        'apicrm' => [
            'class' => 'app\modules\apicrm\Module',
        ],
        'teamrentfields' => [
            'class' => 'app\modules\teamrentfields\TeamRentFields',
            'controllerMap' => [
                'rentfields' => 'app\modules\teamrentfields\controllers\RentFieldsController'
            ],
        ],
    ],
    'params' => $params,
];

if ($additional_config) {
    $config = array_merge_recursive($config, $additional_config);
}


if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module'
//        'allowedIPs' => ['*']
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*'],
    ];
}

return $config;
