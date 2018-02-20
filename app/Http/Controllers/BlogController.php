<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Comment;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::with(['author','category','comments'])->latest()->paginate(5);

        $categories = Category::all();

        return view('blog.index', compact('posts','categories'));
    }

    public function show(Post $post)
    {
        $categories = Category::with('posts')->get();

        $comments = Comment::where('post_id',$post->id)->get();

        return view('blog.show', compact('post','categories','comments'));
    }

}
