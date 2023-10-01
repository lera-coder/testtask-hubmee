<?php

namespace App\Modules\Post\Queries;

use App\Exceptions\API\PostNotFoundException;
use App\Models\Post;
use App\Modules\Interfaces\Query;
use Throwable;

class GetPostById extends Query
{


    /**
     * @param array $parameters
     * @return array
     */
    public function handle(array $parameters): array
    {
        try {
            $id = $parameters['id'];
            if (gettype($id) != 'int' && $id < 0) {
                throw new PostNotFoundException();
            }
            $post = Post::find($id);

            return [
                'post' => $post
            ];
        } catch (Throwable $e) {
            return $this->errorHandler->handle($e);
        }


    }
}
