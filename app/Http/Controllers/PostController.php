<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/posts",
     *     tags={"Posts"},
     *     operationId="show",
     *     summary="Retrieve all posts inside the database",
     *     @OA\Response(response="200", description="Success"),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function index()
    {
        $post = Post::all();
        Log::info($post);

        return response()->json($post, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info("Test");

        $validator = $request->validate([
            "title"=> "required|string|max:255",
            "content"=> "required|string",
            "author"=> "required|string|max:255",
        ]);

        $post = Post::create($validator);

        return response()->json(["message"=> "Post sucefully created",$post], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $selectedPost = Post::find($id);

        if ( is_null($selectedPost) ) {
            return response()->json(["message"=> "Post not found"], 404);
        }

        return response()->json($selectedPost, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validator = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
        ]);

        $selectedPost = Post::find($id);

        if ( is_null($selectedPost) ) {
            return response()->json(['message'=> 'Post not found'], 404);
        }

        // Log::info('Post updated', $selectedPost->update($request->all()));
        $selectedPost->update($validator);


        return response()->json(["message"=> "Post sucefully updated" ,$selectedPost], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $selectedPost = Post::find($id);

        if ( is_null($selectedPost) ) {
            return response()->json(['message'=> 'Post not found'], 404);
        }

        $selectedPost->delete();

        return response()->json(["message"=> "Post sucefully deleted", $selectedPost], 200);
    }
}
