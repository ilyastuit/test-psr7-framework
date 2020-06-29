<?php


use Framework\Http\Application;

/* @var Application $app */

$app->get('home', '/', \App\Http\Action\Task\IndexAction::class);
$app->get('task_page', '/task/{page}', \App\Http\Action\Task\IndexAction::class, ['tokens' => ['page' => '\d+']]);
$app->post('task_create', '/', \App\Http\Action\Task\CreateAction::class);
