<?php

namespace Tests\Unit\Modules\Post\Queries;

use App\Exceptions\ErrorHandler;
use App\Exceptions\ErrorMessage;
use App\Models\Post;
use App\Models\User;
use App\Modules\Post\Queries\GetPostById;
use Tests\TestCase;

class GetPostByIdTest extends TestCase
{
    private ErrorHandler $errorHandler;

    public function __construct(string $name)
    {
        $this->errorHandler = new ErrorHandler();
        parent::__construct($name);
    }

    public function testOnNotFound() {
        $query = new GetPostById($this->errorHandler);
        $result = $query->handle(['id' => 666666666666666666666666]);
        $this->assertIsArray($result);
        $this->assertArrayHasKey('error', $result);
        $this->assertArrayHasKey('code', $result);
        $this->assertEquals(ErrorMessage::POST_NOT_FOUND, $result['error']);
        $this->assertEquals(404, $result['code']);
    }

    public function testOnSuccess() {
        $user = User::factory()->create();
        $post = Post::factory()
            ->create(['user_id' => $user->id]);

        $query = new GetPostById($this->errorHandler);
        $result = $query->handle(['id' => $post->id]);
        $this->assertIsArray($result);
        $this->assertArrayHasKey('post', $result);
        $this->assertTrue($result['post']->is($post));
    }
}
