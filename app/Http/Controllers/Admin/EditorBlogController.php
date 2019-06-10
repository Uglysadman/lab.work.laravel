<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use Illuminate\Support\Facades\Auth;

class EditorBlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:edit-posts');
        $this->middleware('can:add-posts');
    }

    public function index()
    {
        $posts = Post::orderby('created_at', 'desc')->paginate(3);
        $comments = Comment::all();
        return view('admin.editorBlog', [
            'posts' => $posts,
            'comments' => $comments
        ]);
    }

    public function store(BlogRequest $request)
    {
        $img_name = $_FILES['img']['name'];
        if (!$img_name){
            $img_name = 'no_image.jpg';
        }

        $post = Post::create([
            'topic' => $request->get('topic'),
            'message' => $request->get('message'),
            'img' => $img_name,
            'user_id' => Auth::user()->id
        ]);

        if (!$post){
            return redirect()->back();
        }

        $request->session()->flash('flash_message', 'Post created');
        return redirect()->route('admin.editorBlog');
    }

    public function update(BlogRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->fill($request->all());

        if(!$post->save()){
            return redirect()->back()->withErrors('Update Error');
        }

        $request->session()->flash('flash_message', 'Post updated');
        return redirect()->route('admin.editorBlog');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if (!$post->delete()){
            return redirect()->back()->withErrors('Delete Error');
        }

        session()->flash('flash_message', 'Post deleted');
        return redirect()->back();
    }
}
