<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use Storage;
use Auth;

class CommentController extends Controller
{
    //
  public function create($post_id)
{
  
    return view('comments.create')->with(['post_id' => $post_id]);
}

  public function store(Request $request,$post_id)
    {
    
      $comment = new Comment;
      $form = $request->all();

      //s3アップロード開始
      $image = $request->file('image');
      
      // バケットの`mylaravel`フォルダへアップロード
      $path = Storage::disk('s3')->putFile('mylaravel', $image, 'public');
      
      // アップロードした画像のフルパスを取得
      $comment->image_path = Storage::disk('s3')->url($path);
      
      // 本文を取得
      $comment->body = $request->body;
      
      // ログインしているユーザーのUser_idを取得
      $comment->user_id = Auth::id();
      
      // コメントが該当する投稿のpost_idを取得
      $comment->post_id = $post_id;
      
      $comment->save();
        return redirect('/');
        
    }

}
