<?php

use App\Http\Middleware\AuthMiddleware;
use Psr\Container\ContainerInterface;
use Zend\Diactoros\Response;

return [
    'dependencies' => [
        'factories' => [
            AuthMiddleware::class => function (ContainerInterface $container) {
                return new AuthMiddleware(new Response());
            },
        ],
    ],

    'auth' => [
        'users' => [],
    ],
];