<?php


use Framework\Http\Application;

/* @var Application $app */

$app->get('home', '/', \App\Http\Action\HelloAction::class);
$app->get('task', '/task', \App\Http\Action\Task\TaskAction::class);
$app->get('task_page', '/task/{page}', \App\Http\Action\Task\TaskAction::class, ['tokens' => ['page' => '\d+']]);
$app->get('task_show', '/task/{id}', \App\Http\Action\Task\TaskAction::class, ['tokens' => ['id' => '\d+']]);