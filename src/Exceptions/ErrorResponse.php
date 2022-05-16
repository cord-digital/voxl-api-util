<?php

namespace Voxl\Util\Exceptions;

use Exception;

class ErrorResponse extends Exception
{

    public function __construct(string $message = "", protected $type = null, int $code = 422)
    {
        parent::__construct($message, $code);
    }

    public function getType()
    {
        return $this->type;
    }

}
