<?php

namespace App\Exceptions\API;

use App\Exceptions\ErrorMessage;
use App\Exceptions\Throwable;
use Exception;

class PostNotFoundException extends Exception
{
   public function __construct(string $message = "", int $code = 404, ?Throwable $previous = null)
   {
       $message = empty($message) ? ErrorMessage::POST_NOT_FOUND : $message;
       parent::__construct($message, $code, $previous);
   }
}
