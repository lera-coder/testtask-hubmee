<?php

namespace App\Exceptions\API;

use App\Exceptions\ErrorMessage;
use App\Exceptions\Throwable;
use Exception;

class AuthenticationException extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        $message = empty($message) ? ErrorMessage::AUTHENTICATION_ERROR : $message;
        $code = 401;
        parent::__construct($message, $code, $previous);
    }
}
