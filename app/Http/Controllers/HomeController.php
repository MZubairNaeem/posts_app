<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::all()->where('user_id', auth()->id());
        return view('post.home',compact('posts'));
    }
    public function post_create()
    {
        $post = Post::where('user_id', auth()->id())->get();
        return view('post.create-post',compact('post'));
    }
    public function post_store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = Auth::user()->id;
        $post->save();
        return redirect()->route('home');
    }
    public function post_delete($id)
    {
        $id = decrypt($id);
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('home');
    }
    public function post_edit($id)
    {
        $id = decrypt($id);
        $post = Post::find($id);
        return view('post.update-post',compact('post'));
    }
    public function post_update(Request $request,$id)
    {
        $post = Post::find($id);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();
        return redirect()->route('home');
    }
}
