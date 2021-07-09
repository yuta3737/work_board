<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Storage;

class CommentController extends Controller
{
    //
      public function show(comment $comment)
  {
    
      return view('post.show')->with(['comments' => $comment->get()]);
  }
}
