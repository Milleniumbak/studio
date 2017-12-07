<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'es',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'STUDIO2045',
             'parsers' =>   [
                   'application/json' => 'yii\web\JsonParser',
                            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Iuser',
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
        // esto de abajo se configuro para rest api
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
            'rules' =>  [
                            [ // ruta de usuario
                                'class' => 'yii\rest\UrlRule', 
                                'controller' => 'restusuario',
                             'extraPatterns' => [
                                'GET autenticacion/<username>/<password>' => 'autenticacion',
                                                ],
                            ],
                            [ // ruta de evento social
                                'class' => 'yii\rest\UrlRule', 
                                'controller' => 'resteventosocial',
                             'extraPatterns' => [
                                'GET guest/<id>' => 'guest',
                                                ],
                            ],                            
                            [ // ruta de imagen de usuario
                                'class' => 'yii\rest\UrlRule', 
                                'controller' => 'restimgusuario',
                             'extraPatterns' => [
                                'GET adicionar/<pkimgusuario>/<fkusuario>/<path>/<idimagecloud>' => 'adicionar',
                                'GET getimage/<pkusuario>' => 'getimage',
                                                ],
                            ],
                        ],
        ],
        
    ],
    'params' => $params,
];
 //habilitar para el modo depurador
/* deshabilitando ya q estamos enviando al servidor de produccion
if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}
*/
return $config;
