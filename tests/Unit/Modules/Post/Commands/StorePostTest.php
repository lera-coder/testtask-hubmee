<?php

namespace Tests\Unit\Modules\Post\Commands;

use App\Exceptions\ErrorHandler;
use App\Exceptions\ErrorMessage;
use App\Models\User;
use App\Modules\Post\Commands\DeletePost;
use App\Modules\Post\Commands\StorePost;
use Tests\TestCase;

class StorePostTest extends TestCase
{
    private ErrorHandler $errorHandler;

    public function __construct(string $name)
    {
        $this->errorHandler = new ErrorHandler();
        parent::__construct($name);
    }

    public function testOnAuthenticationError()
    {
        $command = new StorePost($this->errorHandler);
        $result = $command->handle(['user' => 12345677]);
        $this->assertIsArray($result);
        $this->assertArrayHasKey('error', $result);
        $this->assertArrayHasKey('code', $result);
        $this->assertEquals(ErrorMessage::AUTHENTICATION_ERROR, $result['error']);
        $this->assertEquals(401, $result['code']);

    }

    public function testOnSuccessful()
    {
        $user = User::factory()->create();
        $command = new StorePost($this->errorHandler);
        $result = $command->handle(['user' => $user, 'request' => [
            'title' => 'title',
            'body' => 'title'
        ]]);
        $this->assertIsArray($result);
        $this->assertArrayHasKey('data', $result);
        $this->assertArrayHasKey('success', $result);
        $this->assertEquals('title', $result['data']->title);
        $this->assertEquals('title', $result['data']->body);

    }

    public function testOnSomethingWentWrong()
    {
        $user = User::factory()->create();
        $command = new StorePost($this->errorHandler);
        $result = $command->handle(['user' => $user, 'request' => [
            'body' => 'title'
        ]]);
        $this->assertIsArray($result);
        $this->assertArrayHasKey('error', $result);
        $this->assertArrayHasKey('code', $result);
        $this->assertEquals(ErrorMessage::SOMETHING_WENT_WRONG, $result['error']);
        $this->assertEquals(500, $result['code']);

    }

}
