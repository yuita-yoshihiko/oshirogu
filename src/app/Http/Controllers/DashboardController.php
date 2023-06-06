<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class DashboardController extends Controller
{
  public function index()
  {
      $isAuthenticated = Auth::check();
  
      $posts = Post::all()->map(function ($post) use ($isAuthenticated) {
          $post->isNotPostOwner = $isAuthenticated ? Auth::id() != $post->user_id : false;
          $post->isLiked = $isAuthenticated ? Auth::user()->islike($post->id) : false;
          
          return $post;
      });
  
      return view('dashboard', ['posts' => $posts, 'isAuthenticated' => $isAuthenticated]);
  }

}