<?php

namespace App\Exceptions;

use Throwable;

class ErrorHandler
{
    /**
     * @param Throwable $e
     * @return string
     */
    public function handle(Throwable $e): string
    {
        if (get_class($e) . startsWith('App\Exceptions')) {
            return $e->getMessage();
        }
        return ErrorMessage::SOMETHING_WENT_WRONG;
    }

}
