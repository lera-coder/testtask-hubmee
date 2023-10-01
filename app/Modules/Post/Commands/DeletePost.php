<?php

namespace App\Modules\Post\Commands;

use App\Exceptions\API\AuthenticationException;
use App\Exceptions\API\NoAccessToPostException;
use App\Exceptions\API\PostNotFoundException;
use App\Models\Post;
use App\Models\User;
use App\Modules\Interfaces\Command;
use Throwable;

class DeletePost extends Command
{
    /**
     * @param array $parameters
     * @return bool[]
     * @throws AuthenticationException
     * @throws NoAccessToPostException
     * @throws PostNotFoundException
     */
    public function handle(array $parameters): array
    {
        try {
            $id = $parameters['id'];
            $user = $parameters['user'];
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

            $result = Post::destroy($id);

            return [
                'success' => $result === 1
            ];
        } catch (Throwable $e) {
            return $this->errorHandler->handle($e);
        }
    }
}
