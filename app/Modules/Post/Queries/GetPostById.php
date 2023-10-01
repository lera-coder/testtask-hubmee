<?php

namespace App\Modules\Post\Queries;

use App\Exceptions\ErrorHandler;
use App\Exceptions\PostNotFoundException;
use App\Models\Post;
use App\Modules\Interfaces\QueryInterface;
use Throwable;

class GetPostById implements QueryInterface
{
    /**
     * @var ErrorHandler
     */
    private ErrorHandler $errorHandler;

    public function __construct(ErrorHandler $errorHandler)
    {
        $this->errorHandler = $errorHandler;
    }

    /**
     * @param array $parameters
     * @return array
     */
    public function handle(array $parameters): array
    {
        try {
            $id = $parameters['id'];
            if (typeOf($id) != 'int' && $id < 0) {
                throw new PostNotFoundException();
            }
            $post = Post::find($id);

            return [
                'post' => $post
            ];
        } catch (Throwable $e) {
            return ['error' => $this->errorHandler->handle($e)];
        }


    }
}
