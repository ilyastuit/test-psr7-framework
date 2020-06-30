<?php


namespace App\Http\Action\Task;


use App\Helper\ValidationHelper;
use App\Model\TaskReadRepository;
use Framework\Template\TemplateRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;

class SaveACtion implements RequestHandlerInterface
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

        if (!isset($_SESSION['userid'])) {
            header('Location: /login');exit;
        }
        $validator = new ValidationHelper();
        if (isset($_SESSION['errors'])) {
            unset($_SESSION['errors']);
        }
        unset($_SESSION['params']);

        $params = $request->getParsedBody();
        $params['id'] = $request->getAttribute('task');
        if ($this->tasks->validate($params)) {
            $this->tasks->update($params);
        }

        header('Location: /');exit;
    }
}