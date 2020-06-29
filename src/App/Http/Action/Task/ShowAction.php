<?php

namespace App\Http\Action\Task;

use App\Model\TaskReadRepository;
use Framework\Template\TemplateRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ShowAction implements RequestHandlerInterface
{
    public function __construct(TaskReadRepository $task, TemplateRenderer $template)
    {
        $this->tasks = $task;
        $this->template = $template;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {

    }
}