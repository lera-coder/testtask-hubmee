<?php

namespace App\Modules\Post\Queries;

use App\Exceptions\ErrorHandler;
use App\Exceptions\PostNotFoundException;
use App\Models\Post;
use App\Modules\Interfaces\QueryInterface;
use Illuminate\Support\Collection;
use Throwable;

class GetAllPosts implements QueryInterface
{
    /**
     * @var ErrorHandler
     */
    private ErrorHandler $errorHandler;

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
    public function handle(array $parameters = []): array
    {
        try {
            return [
                'posts' => Post::all()
            ];

        } catch (Throwable $e) {
            return $this->errorHandler->handle($e);
        }

    }
}
