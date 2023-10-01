<?php

namespace App\Modules\Post\Queries;

use App\Models\Post;
use App\Modules\Interfaces\Query;
use Throwable;

class GetAllPosts extends Query
{

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
