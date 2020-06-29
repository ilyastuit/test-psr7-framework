<?php

namespace App\Http\Action\Task;

use App\Model\TaskReadRepository;
use Framework\Template\TemplateRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;

class TaskAction implements RequestHandlerInterface
{
    private const PER_PAGE = 5;

    private $tasks;
    private $template;

    public function __construct(TaskReadRepository $tasks, TemplateRenderer $template)
    {
        $this->tasks = $tasks;
        $this->template = $template;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $pager = new Pagination(
            $this->tasks->countAll(),
            $request->getAttribute('page') ?: 1,
            self::PER_PAGE
        );

        $tasks = $this->tasks->getAll(
            $pager->getOffset(),
            $pager->getLimit()
        );

        return new HtmlResponse($this->template->render('app/task/index', [
            'tasks' => $tasks,
            'pager' => $pager,
        ]));
    }
}