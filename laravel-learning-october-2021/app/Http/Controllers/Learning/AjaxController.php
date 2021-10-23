<?php

namespace App\Http\Controllers\Learning;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
    /**
     * Create a new controller instance
     *
     * @return void
     */
    public function myPost()
    {
        return view('posts.my-post');
    }

    public function submitPost(Request $request)
    {
        // We are collecting all data submitting via Ajax :
        $input = $request->all();

        $post = new Post();
        $post->name = $input['name'];
        $post->description = $input['description'];
        $post->status = $input['status'];
        $post->save();

        // Sending json response to client :
        return response()->json([
            'status' => true,
            'data' => $input
        ]);
    }
}
