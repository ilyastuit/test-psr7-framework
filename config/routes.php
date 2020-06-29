<?php

use App\Http\Action\BlogAction;
use App\Http\Action\HelloAction;
use Framework\Http\Application;

/* @var Application $app */

$app->get('home', '/', HelloAction::class);
$app->get('blog', '/blog', BlogAction::class);
$app->get('blog_show', '/blog/{id}', BlogAction::class, ['tokens' => ['id' => '\d+']]);