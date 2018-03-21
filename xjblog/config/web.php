<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'xjblog-admin',//区分其他应用的唯一标识ID
    'basePath' => dirname(__DIR__),//指定应用的根目录（在根目录下应该有mvc对应的模式）系统常用@app来代表这个路径

//    'aliases'=>[//别名指定路径
//        '@name1'=>'path/to/path1',
//        '@name2'=>'path/to/path2'
//    ],

    'bootstrap' => ['log'],//指定启动阶段要运行的组件,放在这里始终被加载的

//    'catchAll'=>[//仅用于网页应用支持，通常在维护模式下使用，同一个方法处理所有用户请求
//        'offline/notice',//路由
//        'param1'=>'value1',//值一
//        'param2'=>'value2',//值二
//    ],

    'components' => [//注册多个在其他地方使用的应用组件，放在这里处理过程中没有被访问就不会实例化
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'C8jyqbHlzNKYOsR2tp6nW05hjSgiBTif',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'error/error',
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
        'db' => $db,//数据库连接
        'db_tuiguo' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=xiaojun',
            'username' => 'root',
            'password' => '123321',
            'charset' => 'utf8',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,//该属性可以指定一个可以全局访问的参数

//    'controllerMap'=>[//可以指定一个控制器访问的是那个控制器的类
//        'account'=>'app\controllers\UserController',
//
//    ]

 //   'timeZone'=>'America/Los_Angeles',//配置PHP运行环境中的默认时区，实际上调用了date_default_timezone_set()

    //以下属性都是默认的 一般不设置，如果需要改变则可以配置,详情参考手册
    'defaultRoute'=>'site',//配置默认控制器
    //注：要想修改默认动作index 则在控制器中定义属性public $defaultAction='say';

    //还有一些配置在应用主题请求之前之后可以进行一些操作

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
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
