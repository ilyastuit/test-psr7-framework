<?php

namespace App\Http\Controller;

use Zend\Diactoros\Response\HtmlResponse;

class SiteController
{
    public function action()
    {
        return new HtmlResponse('Hello');
    }
}