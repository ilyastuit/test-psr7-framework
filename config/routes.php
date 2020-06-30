<?php


use Framework\Http\Application;

/* @var Application $app */

$app->get('home', '/', \App\Http\Action\Task\IndexAction::class);
$app->post('task_create', '/', \App\Http\Action\Task\CreateAction::class);
$app->any('edit_task', '/edit/{task}', \App\Http\Action\Task\EditAction::class, ['tokens' => ['task' => '\d+']]);
$app->get('task_page', '/task/{page}', \App\Http\Action\Task\IndexAction::class, ['tokens' => ['page' => '\d+']]);
$app->any('login', '/login', \App\Http\Action\LoginAction::class);
$app->get('cabinet', '/cabinet', \App\Http\Action\CabinetAction::class);
