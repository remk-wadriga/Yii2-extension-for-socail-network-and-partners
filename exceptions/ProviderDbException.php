<?php

namespace app\extensions\provider\exceptions;

class ProviderDbException extends ProviderBaseException
{
    const NOT_FOUND = 1004;
    const INVALID_PROVIDER_CLASS = 1005;

    public function getName()
    {
        return 'Provider db error';
    }
}