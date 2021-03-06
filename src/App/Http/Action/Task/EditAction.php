<?php


namespace App\Http\Action\Task;


use App\Helper\ValidationHelper;
use App\Model\TaskReadRepository;
use Framework\Template\TemplateRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;

class EditAction implements RequestHandlerInterface
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

        $task = $this->tasks->find($request->getAttribute('task'));
        $_SESSION['params']['username'] = $task->username ?? null;
        $_SESSION['params']['email'] = $task->email ?? null;
        $_SESSION['params']['text'] = $task->content ?? null;
        $_SESSION['params']['checked'] = $task->checked ?? null;

        return new HtmlResponse($this->template->render('app/cabinet/edit', [
            'task' => $task,
            'validator' => $validator,
        ]));
    }
}