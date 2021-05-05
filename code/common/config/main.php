<?php


return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@api' => dirname(dirname(__DIR__)) . '/api',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'modules' => [
        'v1' => [
            'class' => \api\modules\v1\Module::class,
        ],
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => sprintf(
                'mysql:host=%s:%s;dbname=%s',
                getenv('MYSQL_HOST'),
                getenv('MYSQL_PORT'),
                getenv('MYSQL_DATABASE')
            ),
            'username' => getenv('MYSQL_USER'),
            'password' => getenv('MYSQL_PASSWORD'),
            'charset' => 'utf8',
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'clientId' => getenv('FACEBOOK_CLIENT_ID'),
                    'clientSecret' => getenv('FACEBOOK_CLIENT_SECRET'),
                    'attributeNames' => ['id', 'name', 'email'],
                ],
            ],
        ]
    ],
];
