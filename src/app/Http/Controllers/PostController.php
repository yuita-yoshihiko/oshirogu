<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Auth::user()->posts()->select('title', 'comment', 'image_path')->paginate(24);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'image_path' => 'required|file|image',
            'comment' => 'required',
        ]);

        $image_path = $request->file('image_path')->store('public/images');

        Post::create([
            'title' => $request->title,
            'comment' => $request->comment,
            'image_path' => basename($image_path),
            'user_id' => $request->user()->id,
        ]);

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $task = Post::find($id);
    
        return view('posts.show', compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $task = Post::find($id);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $task = Post::find($id);

        $task->title = $request->title;
        $task->memo = $request->memo;
        $task->save();

        return to_route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = Post::find($id);
        $task->delete();

        return to_route('posts.index');
    }
}
