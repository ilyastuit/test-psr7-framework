<?php


use Framework\Http\Application;

/* @var Application $app */

$app->get('home', '/', \App\Http\Action\Task\IndexAction::class);
$app->post('task_create', '/', \App\Http\Action\Task\CreateAction::class);
$app->get('edit_task', '/edit/{task}', \App\Http\Action\Task\EditAction::class, ['tokens' => ['task' => '\d+']]);
$app->post('save_task', '/edit/{task}', \App\Http\Action\Task\SaveACtion::class, ['tokens' => ['task' => '\d+']]);
$app->get('task_page', '/task/{page}', \App\Http\Action\Task\IndexAction::class, ['tokens' => ['page' => '\d+']]);
$app->any('login', '/login', \App\Http\Action\LoginAction::class);
$app->get('cabinet', '/cabinet', \App\Http\Action\CabinetAction::class);
$app->get('cabinet_page', '/cabinet/{page}', \App\Http\Action\CabinetAction::class, ['tokens' => ['page' => '\d+']]);
$app->get('logout', '/cabinet/logout', \App\Http\Action\LogoutAction::class);
