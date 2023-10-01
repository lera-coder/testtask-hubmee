<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Post;
use App\Modules\Post\Queries\GetAllPosts;
use App\Modules\Post\Queries\GetPostById;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(GetAllPosts $query): JsonResponse
    {
        $result = $query->handle();

        if (array_key_exists('error', $result)) {
            return response()->json([
                'status' => 'failure',
                'message' => $result['error'],
            ], $result['code']);
        }

        return response()->json([
            'status' => 'success',
            'data' => $result['posts'],
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id, GetPostById $query)
    {
        $result = $query->handle(['id' => $id]);
        if (array_key_exists('error', $result)) {
            return response()->json([
                'status' => 'failure',
                'message' => $result['error'],
            ], $result['code']);
        }

        return response()->json([
            'status' => 'success',
            'data' => $result['post'],
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
