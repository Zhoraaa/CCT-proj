<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    //
    public function postSave(Request $postRaw)
    {

        $postData = $postRaw->validate([
            "theme" => "required",
            "text" => "required",
        ]);

        if (!$postRaw->post_id) {
            $post_id = Post::insertGetId([
                'theme' => $postRaw->theme,
                'text' => $postRaw->text,
                'post_type_id' => 1,
                'author_id' => Auth::id(),
                'reply_to' => null,
            ]);
        } else {
            $post = Post::find($postRaw->post_id)
                ->update([
                    'theme' => $postRaw->theme,
                    'text' => $postRaw->text,
                ]);
            $post_id = $postRaw->post_id;
        }

        return redirect()->route('seePost', ['id' => $post_id]);
    }
    public function allPosts()
    {
        $posts = Post::paginate(10)->where('post_type_id', 1);

        return view("post.forum", compact("posts"));
    }
    public function seePost($request)
    {

        $post = Post::where("id", $request)->first();

        return view("post.only", compact("post"));
    }
    public function postEditor()
    {
        return view("post.editor");
    }

    public function postEdit(Request $request)
    {
        $post = Post::find($request->id);

        return view('post.editor', compact('post'));
    }
    public function postDelete(Request $request)
    {
        $post = DB::table("posts")->where('id', $request->id)->delete();

        return redirect()->route("forum");
    }
}
