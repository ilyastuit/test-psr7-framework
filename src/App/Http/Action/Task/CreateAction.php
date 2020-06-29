<?php

namespace App\Http\Action\Task;

use App\Model\TaskReadRepository;
use Framework\Template\TemplateRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;

class CreateAction implements RequestHandlerInterface
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
        session_start();
        if (isset($_SESSION['errors'])) {
            unset($_SESSION['errors']);
        }
        unset($_SESSION['params']);

        $params = $request->getParsedBody();
        if ($this->tasks->validate($params)) {

            $this->tasks->create($params);
        }

        header('Location: /');exit;
    }
}