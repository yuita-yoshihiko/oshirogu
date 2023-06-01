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
        return view('posts.index');
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
        Post::create([
            'title' => $request->title,
            'image_path' => $request->image_path,
            'comment' => $request->comment,
            'user_id' => $request->user()->id,
        ]);

        return to_route('posts.index');
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
