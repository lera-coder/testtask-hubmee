<?php

namespace App\Modules\Post\Commands;

use App\Exceptions\API\AuthenticationException;
use App\Models\Post;
use App\Models\User;
use App\Modules\Interfaces\Command;
use Throwable;

class StorePost extends Command
{

    /**
     * @param array $parameters
     * @return array
     */
    public function handle(array $parameters): array
    {
        try {
            $user = $parameters['user'];

            if (gettype($user) != 'object' && $user instanceof User) {
                throw new AuthenticationException();
            }

            $post = new Post([
                'title' => $parameters['title'],
                'description' => $parameters['description'],
                'user_id' => $user->id,
            ]);

            $result = $post->save();

            return [
                'success' => $result,
                'data' => $post
            ];
        } catch (Throwable $e) {
            return $this->errorHandler->handle($e);
        }
    }
}
