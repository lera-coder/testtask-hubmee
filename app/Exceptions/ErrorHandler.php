<?php

namespace App\Exceptions;

use Throwable;

class ErrorHandler
{
    /**
     * @param Throwable $e
     * @return array
     */
    public function handle(Throwable $e): array
    {
        if (str_starts_with(get_class($e), 'App\Exceptions')) {
            return [
                'error' => $e->getMessage(),
                'code' => $e->getCode()
            ];
        }
        return [
            'error' => ErrorMessage::SOMETHING_WENT_WRONG,
            'code' => 500
        ];
    }

}
