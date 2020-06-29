<?php

use App\Http\Middleware\ErrorHandlerMiddleware;
use App\Http\Middleware\NotFoundMiddleware;
use Framework\Http\Application;
use Framework\Http\Pipeline\MiddlewareResolver;
use Framework\Http\Router\AuraRouterAdapter;
use Framework\Http\Router\Router;
use Framework\Template\TemplateRenderer;
use Framework\Template\Twig\TwigRenderer;
use Psr\Container\ContainerInterface;
use Zend\Stratigility\Middleware\ErrorResponseGenerator;

return [
    'dependencies' => [
        'abstract_factories' => [
            Zend\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory::class,
        ],
        'factories' => [
            Application::class => function (ContainerInterface $container) {
                return new Application(
                    $container->get(MiddlewareResolver::class),
                    $container->get(Router::class),
                    $container->get(NotFoundMiddleware::class)
                );
            },
            Router::class => function () {
                return new AuraRouterAdapter(new Aura\Router\RouterContainer());
            },
            MiddlewareResolver::class => function (ContainerInterface $container) {
                return new MiddlewareResolver($container, new Zend\Diactoros\Response());
            },
            ErrorHandlerMiddleware::class => function (ContainerInterface $container) {
                    return new ErrorHandlerMiddleware(
                        $container->get(TemplateRenderer::class)
                );
            },
        ],
    ],

    'debug' => true,
];