<?php


namespace App\Http\Action;


use App\Helper\ValidationHelper;
use App\Model\TaskReadRepository;
use App\Model\UserReadRepository;
use Framework\Template\TemplateRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;

class LoginAction implements RequestHandlerInterface
{
    private $user;
    private $template;

    public function __construct(UserReadRepository $user, TemplateRenderer $template)
    {
        $this->user = $user;
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

        if (isset($_SESSION['userid'])) {
            header('Location: /cabinet');exit;
        }

        if ($this->user->validate($params)) {
            $_SESSION['userid'] = $this->user->find(1)['id'];
        }

        $validator = new ValidationHelper();

        return new HtmlResponse($this->template->render('app/hello', [
            'params' => $params,
            'validator' => $validator,
        ]));
    }
}