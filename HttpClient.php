<?php

namespace app\extensions\provider;

use nodge\eauth\oauth\HttpClient as NodgeHttpClient;

class HttpClient extends NodgeHttpClient
{
    private $allowedMethods = ['GET', 'POST', 'PUT'];

    public function setMethod($method)
    {
        $method = strtoupper($method);
        if (in_array($method, $this->allowedMethods)) {
            $this->method = $method;
        }
    }
}