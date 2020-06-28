<?php

use App\Http\ActionResolver;
use App\Http\Controller\SiteController;
use App\Http\Router\AuraRouterAdapter;
use App\Http\Router\Exception\RequestNotMatchedException;
use Aura\Router\RouterContainer;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\SapiEmitter;
use Zend\Diactoros\ServerRequestFactory;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

$aura = new RouterContainer();
$routes = $aura->getMap();

$routes->get('action','/', [SiteController::class, 'index']);

$router = new AuraRouterAdapter($aura);
$resolver = new ActionResolver();

$request = ServerRequestFactory::fromGlobals();

try {
    $result = $router->match($request);
    foreach ($result->getAttributes() as $item => $value) {
        $request = $request->withAttribute($item, $value);
    }
    $action = $resolver->resolve($result->getHandler());
    $response = $action($request);
} catch (RequestNotMatchedException $e) {
    $response = new HtmlResponse('Not Found');
}

$emitter = new SapiEmitter();
$emitter->emit($response);