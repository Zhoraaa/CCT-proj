<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller {
    //
    public function allPosts() {
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
    public function postSave(Request $postRaw) {

        $postData = $postRaw->validate([
            "theme" => "required",
            "text" => "required",
        ]);

        $post = Post::create([
            'theme' => $postRaw->theme,
            'text' => $postRaw->text,
            'post_type_id' => 1,
            'author_id' => Auth::id(),
            'reply_to' => null,
        ]);


        return redirect()->route('forum');
    }

    public function postEdit(Request $id) {

        
        return redirect()->route("forum");
    }
    public function postDelete(Request $id) {
        
        $post = DB::table("posts")->where('id', id)->delete();

        return redirect()->route("forum");
    }

}
