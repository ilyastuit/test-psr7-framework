<?php

namespace App\Http\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;

class SiteController
{
    public function index(ServerRequestInterface $request)
    {
        $name = $request->getQueryParams()['name'] ?? 'Guest';
        return new HtmlResponse('Hello ' . $name);
    }
}