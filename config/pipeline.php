<?php

use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\ErrorHandlerMiddleware;
use Framework\Http\Application;
use Framework\Http\Middleware\RouteMiddleware;

/* @var Application $app */

$app->pipe(ErrorHandlerMiddleware::class);
$app->pipe(RouteMiddleware::class);

$app->pipe('cabinet', AuthMiddleware::class);

$app->pipe(Framework\Http\Middleware\DispatchMiddleware::class);
