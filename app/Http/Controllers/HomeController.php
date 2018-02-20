<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use File;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $posts = Post::with(['author','category'])->latest()->paginate(5);

      return view('home', compact('posts'));
    }

    public function create()
    {
      $categories = Category::all();

      return view('create', compact('categories'));
    }


    public function store(Request $request)
    {
      $this->validate($request, [
          'image'   => 'image|mimes:jpeg,png,jpg|max:2048',
          'title'   => 'required|min:5|max:500',
          'slug'    => 'required|min:5|max:500',
          'excerpt' => 'required|min:10',
          'body'    => 'required|min:10'
      ]);

      $post = new Post;
      $post->author_id = \Auth::id();
      $post->title = $request->title;
      $post->slug = $request->slug;
      $post->excerpt = $request->excerpt;
      $post->body = $request->body;
      $post->category_id = $request->category_id;

      if ($request->hasFile('image')) {

        $imageName = 'post-'.time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('img'), $imageName);

        $post->image = $imageName;
      }

      $post->save();

      return back();
    }

    public function edit(Request $request, $id)
    {
      $post = Post::find($id);
      $categories = Category::all();

      return view('edit', compact('post','categories'));
    }

    public function update(Request $request, $id)
    {
      $this->validate($request, [
          'image'   => 'image|mimes:jpeg,png,jpg|max:2048',
          'title'   => 'required|max:500',
          'slug'    => 'required|max:500',
          'excerpt' => 'required|min:10',
          'body'    => 'required|min:10',
          'category_id' => 'required',
      ]);

      $post = Post::findOrFail($id);

      $post->title = $request->title;
      $post->slug = $request->slug;
      $post->excerpt = $request->excerpt;
      $post->body = $request->body;
      $post->category_id = $request->category_id;

      if ($request->hasFile('image')) {

        File::delete(public_path('img/') . $post->image);

        $imageName = 'post-'.time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('img'), $imageName);

        $post->image = $imageName;
      }

      $post->save();

      return back();

    }

    public function destroy($id)
    {
      $post = Post::findOrFail($id);

      File::delete(public_path('img/') . $post->image);

      $post->delete();

      return back();
    }
}
