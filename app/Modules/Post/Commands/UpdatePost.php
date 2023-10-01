<?php

namespace App\Modules\Post\Commands;

use App\Exceptions\API\AuthenticationException;
use App\Exceptions\API\NoAccessToPostException;
use App\Exceptions\API\PostNotFoundException;
use App\Models\Post;
use App\Models\User;
use App\Modules\Interfaces\Command;
use Throwable;

class UpdatePost extends Command
{

    public function handle(array $parameters): array
    {
        try {
            $user = $parameters['user'];
            $id = $parameters['id'];
            $post = Post::find($id);

            if (gettype($user) != 'object' && !$user instanceof User) {
                throw new AuthenticationException();
            }

            if (empty($post)) {
                throw new PostNotFoundException();
            }

            if (!$user->hasAccessToPost(Post::find($id))) {
                throw new NoAccessToPostException();
            }

            $post = Post::find($id);
            $result = $post->update($parameters['request']);

            return [
                'success' => $result,
                'data' => $post
            ];
        } catch (Throwable $e) {
            return $this->errorHandler->handle($e);
        }
    }
}
