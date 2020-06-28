<?php

namespace App\Http\Router\Exception;

use Psr\Http\Message\ServerRequestInterface;

class RequestNotMatchedException extends \LogicException
{
    private $request;

    public function __construct(ServerRequestInterface $request)
    {
        parent::__construct();
        $this->request = $request;
    }

    public function getRequest() {
        return $this->request;
    }
}