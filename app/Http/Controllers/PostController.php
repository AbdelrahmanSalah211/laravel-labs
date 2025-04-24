<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;


class PostController extends Controller{

  public function index(){
    $posts = Post::all();
    return view('posts.index', compact('posts'));
  }

  public function create(){
    // $users = User::all();
    return view('posts.create');
  }


  public function store(Request $request){
    $validated = $request->validate([
      'title' => 'required|string|max:255',
      'body' => 'required|string',
    ]);

    auth()->user()->posts()->create($validated);

    return redirect()->route('posts.index')->with('success', 'Post created successfully!');
  }


  public function show(string $id){
    return view('layouts.post', ['title' => 'Show Post', 'message' => 'Display the specified resource with id: '. $id .'.']);
  }


  public function edit(string $id){
    $post = Post::find($id);

    if ($post->user_id !== auth()->id()) {
      abort(403, 'Unauthorized action.');
  }

    return view('posts.edit', compact('post'));
  }


  public function update(Request $request, string $id){
    $validated = $request->validate([
      'title' => 'required|string|max:255',
      'body' => 'required|string',
    ]);

    $post = Post::findOrFail($id);

    if ($post->user_id !== auth()->id()) {
      abort(403, 'Unauthorized action.');
    }

    $post->update($validated);

    return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
  }


  public function destroy(string $id){
    $post = Post::findOrFail($id);

    if ($post->user_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }

    $post->delete();

    return redirect()->route('posts.index')->with('success', 'Post soft-deleted successfully!');
  }
}
