<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(3);
        $comments = Comment::all();
        return view('blog', [
            'posts' => $posts,
            'comments' => $comments
        ]);
    }
}
