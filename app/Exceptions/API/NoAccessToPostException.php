<?php

namespace App\Exceptions\API;

use App\Exceptions\ErrorMessage;
use App\Exceptions\Throwable;
use Exception;

class NoAccessToPostException extends Exception
{
    public function __construct(string $message = "", int $code = 401, ?Throwable $previous = null)
    {
        $message = empty($message) ? ErrorMessage::NO_ACCESS_TO_POST : $message;
        parent::__construct($message, $code, $previous);
    }
}
