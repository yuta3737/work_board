<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Post;
use App\Http\Requests\PostRequest; 
use App\Comment;
use Storage;
use Auth;


class PostController extends Controller
{
    
  

public function create(Post $post,Request $request)
{
    
      return view('posts.create');
 
}

  public function index(Post $post)
    {
        return view('posts.index')->with(['posts' => $post->get()]);  
      
    }
    
    public function store(Request $request)
    {
        
      $post = new Post;
      $form = $request->all();
      
      if($request->file('image') == null){
        
        $image = null;
        
      }else{
        
      //s3アップロード開始
      $image = $request->file('image');
        
      // バケットの`mylaravel`フォルダへアップロード
      $path = Storage::disk('s3')->putFile('mylaravel', $image, 'public');
      
      // アップロードした画像のフルパスを取得
      // $post->image_path = Storage::disk('s3')->url($path);  
      
      $post->image_path = $path;
      
      }
      // タイトルを取得
      $post->title = $request->title;
      
      // ログインしているユーザーのUser_idを取得
      $post->user_id = Auth::id();

      $post->save();
      
      return redirect('/posts/' . $post->id);
    
    }
        
        
    
  public function show(Post $post,Comment $comment)
  {
    // 該当するpost_idを探す
      $comment = Comment::where('post_id', $post->id);
      
      return view('posts.show')->with(['post' => $post,'comments' => $comment->get()]);
      
  }
     
  public function edit(Post $post)
{
    return view('posts.edit')->with(['post' => $post]);
}   

public function update(Request $request,Post $post)
{
      // $post = new Post;
      $form = $request->all();
     
      if($request->file('image') == null){
        
        $image = null;
        
      }else{
      //s3アップロード開始
      $image = $request->file('image');
      
      // バケットの`mylaravel`フォルダへアップロード
      $path = Storage::disk('s3')->putFile('mylaravel', $image, 'public');
      
      // アップロードした画像のフルパスを取得
      $post->image_path = Storage::disk('s3')->url($path);
      
      }
      
      // タイトルを取得
      $post->title = $request->title;
      
      // ログインしているユーザーのUser_idを取得
      $post->user_id = Auth::id();
     
      $post->save();
      
      return redirect('/posts/' . $post->id);
}

public function delete(Post $post,Request $request)
{
  if(($request->image_path == null)){
    
    $post->delete();
    
  }else{
    $image = $request->image_path;
    $s3_delete = Storage::disk('s3')->delete($image);
    $db_delete = Post::where('image',$image)->delete();
    $post->delete();
  }
  
    
    return redirect('/');
}
}
