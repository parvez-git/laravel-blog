<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
  
    public function store(Request $request)
    {
      $this->validate($request,[
        'content' => 'required|min:3'
      ]);

      $comment = new Comment;
      $comment->user_id = \Auth::id();
      $comment->post_id = $request->post_id;
      $comment->content = $request->content;
      $comment->save();

      return back();
    }
}
