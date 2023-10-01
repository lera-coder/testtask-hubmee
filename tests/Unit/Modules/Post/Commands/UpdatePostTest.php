<?php

namespace Tests\Unit\Modules\Post\Commands;

use App\Exceptions\ErrorHandler;
use App\Exceptions\ErrorMessage;
use App\Models\Post;
use App\Models\User;
use App\Modules\Post\Commands\UpdatePost;
use Tests\TestCase;

class UpdatePostTest extends TestCase
{
    private ErrorHandler $errorHandler;
    private User $user;

    public function __construct(string $name)
    {
        $this->errorHandler = new ErrorHandler();
        $this->user = new User();
        parent::__construct($name);
    }

    public function testOnPostDoesNotExist(){
        $command = new UpdatePost($this->errorHandler);
        $result = $command->handle(['id' => 666666666666666666666666, 'user' => $this->user]);
        $this->assertIsArray($result);
        $this->assertArrayHasKey('error', $result);
        $this->assertArrayHasKey('code', $result);
        $this->assertEquals(ErrorMessage::POST_NOT_FOUND, $result['error']);
        $this->assertEquals(404, $result['code']);
    }

    public function testOnAuthenticationError(){
        $command = new UpdatePost($this->errorHandler);
        $result = $command->handle(['id' => 666666666666666666666666, 'user' => 12345677]);
        $this->assertIsArray($result);
        $this->assertArrayHasKey('error', $result);
        $this->assertArrayHasKey('code', $result);
        $this->assertEquals(ErrorMessage::AUTHENTICATION_ERROR, $result['error']);
        $this->assertEquals(401, $result['code']);
    }

    public function testOnNoAccessToPost(){
        $user = User::factory()->create();
        $post = Post::factory()
            ->create(['user_id' => $user->id]);
        $this->user->id = $user->id + 1;
        $command = new UpdatePost($this->errorHandler);
        $result = $command->handle(['id' => $post->id, 'user' => $this->user, 'request' => ['title' => 'success']]);
        $this->assertIsArray($result);
        $this->assertArrayHasKey('error', $result);
        $this->assertArrayHasKey('code', $result);
        $this->assertEquals(ErrorMessage::NO_ACCESS_TO_POST, $result['error']);
        $this->assertEquals(401, $result['code']);
    }

    public function testOnSuccess(){
        $user = User::factory()->create();
        $post = Post::factory()
            ->create(['user_id' => $user->id]);
        $command = new UpdatePost($this->errorHandler);
        $result = $command->handle(['id' => $post->id, 'user' => $user, 'request' => ['title' => 'success']]);
        $this->assertIsArray($result);
        $this->assertArrayHasKey('data', $result);
        $this->assertArrayHasKey('success', $result);
        $this->assertEquals('success', $result['data']->title);
    }

}
