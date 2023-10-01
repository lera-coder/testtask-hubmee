<?php

namespace App\Exceptions;

use Exception;

class PostNotFoundException extends Exception
{
   public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
   {
       $message = empty($message) ? ErrorMessage::POST_NOT_FOUND : $message;
       $code = 404;
       parent::__construct($message, $code, $previous);
   }
}
