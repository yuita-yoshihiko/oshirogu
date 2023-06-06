<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class DashboardController extends Controller
{
    public function index()
    {
      $posts = Post::all();
      $isAuthenticated = Auth::check();

      foreach ($posts as $post) {
        $isNotPostOwner = $isAuthenticated ? Auth::id() != $post->user_id : false;
        $isLiked = $isAuthenticated ? Auth::user()->islike($post->id) : false;
      }

      return view('dashboard', ['posts' => $posts], compact('post', 'isAuthenticated', 'isNotPostOwner', 'isLiked'));
    }

}