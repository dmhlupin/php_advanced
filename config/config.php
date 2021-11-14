<?php

use app\engine\Db;
use app\engine\Request;
use app\models\repositories\BasketRepository;
use app\models\repositories\OrdersRepository;
use app\models\repositories\ProductRepository;
use app\models\repositories\UserRepository;

return [
    'root' => dirname(__DIR__),
    'controller_namespace' => '\\app\\controllers\\',
    'ds' => DIRECTORY_SEPARATOR,
    'views_dir' => dirname(__DIR__) . "/views/",
    'templates_dir' => dirname(__DIR__) . "/templates/",
    'components' => [
        'db' => [
            'class' => Db::class,
            'driver' => 'mysql',
            'host' => 'localhost:3307',
            'login' => 'root',
            'password' => '123456',
            'database' => 'shop',
            'charset' => 'utf8',
        ],
        'request' => [
            'class' => Request::class
        ],
        'basketRepository' => [
            'class' => BasketRepository::class
        ],
        'productRepository' => [
            'class' => ProductRepository::class
        ],
        'ordersRepository' => [
            'class' => OrdersRepository::class
        ],
        'userRepository' => [
            'class' => UserRepository::class
        ]
    ]
];