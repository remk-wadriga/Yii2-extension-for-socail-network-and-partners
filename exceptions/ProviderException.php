<?php

namespace app\extensions\provider\exceptions;

class ProviderException extends ProviderBaseException
{
    const LOGIN_FAILED = 1204;
    const INVALID_PARAMS = 1205;
    const PROVIDER_NOT_FOUND = 1206;

    public function getName()
    {
        return 'Provider error';
    }
}