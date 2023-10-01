<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\Post\StorePostRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class StorePostRequestTest extends TestCase
{
    public function testOnNoTitle(){
        $request = new StorePostRequest();

        $validator = Validator::make([
            'body' => 'this is a test',
        ], $request->rules());

        $this->assertFalse($validator->passes());
    }

    public function testOnSuccessful(){
        $request = new StorePostRequest();

        $validator = Validator::make([
            'body' => 'this is a test',
            'title' => 'title',
        ], $request->rules());

        $this->assertTrue($validator->passes());
    }

    public function testOnNoBody(){
        $request = new StorePostRequest();

        $validator = Validator::make([
            'title' => 'title',
        ], $request->rules());

        $this->assertFalse($validator->passes());
    }

    public function testOnBodyIsNotString(){
        $request = new StorePostRequest();

        $validator = Validator::make([
            'body' => 14528292,
            'title' => 'alalalla',
        ], $request->rules());

        $this->assertFalse($validator->passes());
    }

    public function testOnTitleIsNotString(){
        $request = new StorePostRequest();

        $validator = Validator::make([
            'body' => 'alalallal',
            'title' => 5464748,
        ], $request->rules());

        $this->assertFalse($validator->passes());
    }

}
