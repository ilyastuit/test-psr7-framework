<?php

namespace App\Http;

class ActionResolver
{
    public function resolve($handle) {
        return is_string($handle) ? new $handle : $handle;
    }
}