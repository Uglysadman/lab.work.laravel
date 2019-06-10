<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Post;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(3);
        $comments = Comment::all();
        return view('blog', [
            'posts' => $posts,
            'comments' => $comments
        ]);
    }

    public function add_comment(CommentRequest $request, $post_id)
    {
        $comment = Comment::create([
            'text_comment' => $request->get('text_comment'),
            'post_id' => $post_id,
            'author' => Auth::user()->login
        ]);

        if (!$comment){
            return redirect()->back();
        }

        $request->session()->flash('flash_message', 'Comment Add');
        return redirect()->route('blog');
    }
}
