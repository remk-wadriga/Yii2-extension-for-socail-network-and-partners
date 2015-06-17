<?php

namespace app\extensions\provider\exceptions;

use app\exceptions\PBCException;

class ProviderBaseException extends PBCException
{
    public function getName()
    {
        return 'Partner error';
    }
}