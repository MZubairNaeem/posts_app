<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
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
        $posts = Post::all()->where('user_name', auth()->id());
        return view('post.home',compact('posts'));
    }
    public function post_create()
    {
        $post = Post::where('user_id', auth()->id())->get();
        $users = User::all();
        return view('post.create-post',compact('post','users'));
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
        $post->user_name = $request->user_name;
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
        $users = User::all();
        return view('post.update-post',compact('post','users'));
    }
    public function post_update(Request $request,$id)
    {
        $post = Post::find($id);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_name = $request->user_name;
        $post->save();
        return redirect()->route('home');
    }
}
