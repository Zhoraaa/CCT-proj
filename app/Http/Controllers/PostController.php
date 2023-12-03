<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function allPosts()
    {
        $posts = Post::paginate(10)->where('post_type_id', 1);

        return view("post.getAll", compact("posts"));
    }
    public function seePost($request) {

        $post = Post::where("id", $request)->first();

        return view("post.only", compact("post"));
    }
    public function postEditor() {
        return view("post.editor");
    }
    public function postSave(Request $postRaw)
    {

        $postData = $postRaw->validate([
            "theme"=> "required",
            "text"=> "required",
        ]);

        $post = new Post();

        $post->theme = $postData['theme'];
        $post->text = $postData['text'];
        $post->post_type_id = '1';
        $post->author_id = '1';
        $post->reply_to = null;

        $post->save();

        return redirect()->route('forum');

    }

}
