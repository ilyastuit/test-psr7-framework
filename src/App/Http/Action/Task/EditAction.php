<?php


namespace App\Http\Action\Task;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class EditAction implements RequestHandlerInterface
{

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        session_start();

        if (!isset($_SESSION['userid'])) {
            header('Location: /login');exit;
        }
    }
}