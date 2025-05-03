<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;


class PostAPIController extends Controller {
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return Auth::user()->posts;
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request){
    $validated = $request->validate([
    'title' => 'required|string',
    'body' => 'required|string'
    ]);

    $post = Auth::user()->posts()->create($validated);
    return response()->json($post, 201);
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id){
    $post = Post::where('user_id', Auth::id())->findOrFail($id);
    return response()->json($post);
  }

    /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id){
    $post = Post::where('user_id', Auth::id())->findOrFail($id);
    $post->update($request->only('title', 'body'));
    return response()->json($post);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id) {
    $post = Post::where('user_id', Auth::id())->findOrFail($id);
    $post->delete();
    return response()->json(['message' => 'Deleted']);
  }
}
