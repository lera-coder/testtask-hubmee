<?php

namespace App\Modules\Interfaces;

use App\Exceptions\ErrorHandler;

abstract class Command
{

    /**
     * @var ErrorHandler
     */
    protected ErrorHandler $errorHandler;

    /**
     * @param ErrorHandler $errorHandler
     */
    public function __construct(ErrorHandler $errorHandler)
    {
        $this->errorHandler = $errorHandler;
    }

    /**
     * @param array $parameters
     * @return array
     */
    abstract public function handle(array $parameters) : array;

}
