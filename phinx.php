<?php

require 'vendor/autoload.php';

/** @var \Interop\Container\ContainerInterface $container */
$container = require 'config/container.php';

return [
    'environments' =>  [
        'default_migration_table' => 'migrations',
        'default_database' => 'app',
        'app' => [
            'connection' => $container->get(PDO::class),
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'app',
            'user' =>  $container->get('config')['pdo']['username'],
            'pass'  =>  $container->get('config')['pdo']['password'],
            'port' => 3306,
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
    ],
    'paths' => [
        'migrations' => 'db/migrations',
        'seeds' =>  'db/seeds',
    ],
];