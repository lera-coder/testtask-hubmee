<?php

namespace Tests\Unit\Modules\Post\Queries;

use App\Exceptions\ErrorHandler;
use App\Models\Post;
use App\Modules\Post\Queries\GetAllPosts;
use Tests\TestCase;

class GetAllPostsTest extends TestCase
{
    private ErrorHandler $errorHandler;

    public function __construct(string $name)
    {
        $this->errorHandler = new ErrorHandler();
        parent::__construct($name);
    }

    public function testOnSuccess() {
        $posts = Post::all();
        $query = new GetAllPosts($this->errorHandler);
        $result = $query->handle();
        $this->assertIsArray($result);
        $this->assertArrayHasKey('posts', $result);
        $this->assertEquals($posts, $result['posts']);
    }

}
