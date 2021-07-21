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
  public function create(Comment $comment,Post $post)
  // $post_id
{
  
    return view('comments.create')->with(['comment' => $comment,'post' => $post]);
    // ->with(['post_id' => $post_id])
}

  public function store(Request $request)
    {
      $comment = new Comment;
      $form = $request->all();
      
      if($request->file('image') == null){
        
        $image = null;
        
      }else{

      //s3アップロード開始
      $image = $request->file('image');
      
      // バケットの`mylaravel`フォルダへアップロード
      $path = Storage::disk('s3')->putFile('mylaravel', $image, 'public');
      
      // アップロードした画像のフルパスを取得
      $comment->image_path = Storage::disk('s3')->url($path);
      
      }
      
      // 本文を取得
      $comment->body = $request->body;
      
      // ログインしているユーザーのUser_idを取得
      $comment->user_id = Auth::id();
      
      // コメントが該当する投稿のpost_idを取得
      $comment->post_id = $request->post_id;
      
      $comment->save();
        // return redirect('/');
      return redirect('/posts/' . $comment->post_id);  
        
    }
    
    public function edit(Comment $comment)
    // 
    {
        return view('comments.edit')->with(['comment' => $comment]);
        // 'comment' => $Comment,
    }
        
        
        
    public function update(Request $request,Comment $comment)
        {
          // $comment = new Comment;
          $form = $request->all();
    
          if($request->file('image') == null){
            
            $image = null;
            
          }else{    
            
          //s3アップロード開始
          $image = $request->file('image');
          
          // バケットの`mylaravel`フォルダへアップロード
          $path = Storage::disk('s3')->putFile('mylaravel', $image, 'public');
          
          // アップロードした画像のフルパスを取得
          $comment->image_path = Storage::disk('s3')->url($path);
          
          }
          
          // 本文を取得
          $comment->body = $request->body;
          
          // ログインしているユーザーのUser_idを取得
          $comment->user_id = Auth::id();
          
          // コメントが該当する投稿のpost_idを取得
         
          
          $comment->save();
            return redirect('/posts/' . $comment->post_id);
            
        }    
        
        public function delete(Comment $comment)
    {
        $comment->delete();
        return redirect('/posts/' . $comment->post_id);
    }
        

}
