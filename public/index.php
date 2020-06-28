<?php

use App\Http\Controller\SiteController;
use Aura\Router\RouterContainer;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\SapiEmitter;
use Zend\Diactoros\ServerRequestFactory;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

### Initialization

$request = ServerRequestFactory::fromGlobals();

### Action

$aura = new RouterContainer();
$routes = $aura->getMap();

$routes->get('action','/', [SiteController::class, 'index']);

$matcher = $aura->getMatcher();
$route = $matcher->match($request);

if (!$route) {
    $action = function (ServerRequestInterface $request) {
      return new HtmlResponse('Not Found', 404);
    };
} else {
    foreach ($route->attributes as $item => $value) {
        $request = $request->withAttribute($item, $value);
    }
    $action = $route->handler;
}

$response = $action($request);

$emitter = new SapiEmitter();
$emitter->emit($response);