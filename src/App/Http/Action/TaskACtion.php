<?php

namespace App\Http\Action;

use App\Model\TaskReadRepository;
use Framework\Template\TemplateRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;

class TaskAction implements RequestHandlerInterface
{
    private $tasks;
    private $template;

    public function __construct(TaskReadRepository $tasks, TemplateRenderer $template)
    {
        $this->tasks = $tasks;
        $this->template = $template;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $tasks = $this->tasks->getAll();

        return new HtmlResponse($this->template->render('app/task/index', [
            'tasks' => $tasks,
        ]));
    }
}