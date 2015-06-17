<?php

namespace app\extensions\provider\exceptions;

class ProviderResponseException extends ProviderBaseException
{
    const RESPONSE_FAIL = 1104;
    const RESPONSE_EMPTY = 1105;
    const RESPONSE_ERROR = 1106;
    const INVALID_RESPONSE = 1107;

    public function getName()
    {
        return 'Provider response error';
    }
}