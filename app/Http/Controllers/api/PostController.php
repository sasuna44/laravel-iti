<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post; 
use App\Http\Requests\PostStoreRequest;
use App\Http\Resources\PostResource; 

class PostController extends Controller
{
     function index()
    {
        $posts = Post::with('user')->get();
        return PostResource::collection($posts);
    }

     function store(PostStoreRequest $request)
    {
        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body, 
            'user_id' => $request->user_id,
        ]);

        return new PostResource($post);
    }

     function show($id)
    {
        $post = Post::with('user')->find($id);
        return new PostResource($post);
    }

     function destroy($id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();
            return response()->json(['message' => 'Post deleted successfully'], 200);
        }
        return response()->json(['message' => 'Post not found'], 404);
    }
}
