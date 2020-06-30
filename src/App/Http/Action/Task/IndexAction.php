<?php

namespace App\Http\Action\Task;

use App\Helper\SortSwitcher;
use App\Helper\ValidationHelper;
use App\Model\Pagination;
use App\Model\TaskReadRepository;
use Framework\Template\TemplateRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;

class IndexAction implements RequestHandlerInterface
{
    private const PER_PAGE = 3;

        private $tasks;
        private $template;

        public function __construct(TaskReadRepository $tasks, TemplateRenderer $template)
        {
            $this->tasks = $tasks;
            $this->template = $template;
        }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        session_start();
        $params['sort'] = $request->getQueryParams()['sort'] ?? 'asc';
        $params['field'] = $request->getQueryParams()['field'] ?? 'username';

        $sortSwitcher = new SortSwitcher();
        $validator = new ValidationHelper();

        $pager = new Pagination(
            $this->tasks->countAll(),
            $request->getAttribute('page') ?: 1,
            self::PER_PAGE,
            $params
        );

        $tasks = $this->tasks->getAll(
            $pager->getOffset(),
            $pager->getLimit(),
            $params
        );

        return new HtmlResponse($this->template->render('app/task/index', [
            'tasks' => $tasks,
            'pager' => $pager,
            'params' => $params,
            'sortSwitcher' => $sortSwitcher,
            'validator' => $validator,
        ]));
    }
}