<?php

namespace App\Exceptions;

use Exception;

class PostNotFoundException extends Exception
{
   public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
   {
       $message = $message ?? ErrorMessage::POST_NOT_FOUND;
       parent::__construct($message, $code, $previous);
   }
}
